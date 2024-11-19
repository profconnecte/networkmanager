<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SSH;

class DnsController extends Controller
{
    public function edit($data)
    {
        $tab = explode("--", $data);
        $name = $tab[0];
        $elementSpecial = $tab[1];
        $type = $tab[2];


        return view('dns.edit', ['name' => $name, 'elementSpecial' => $elementSpecial, 'typeEnre' => $type]);
    }

    public function ajout()
    {
        return view('dns.add');
    }

    public function display($records)
    {
        $type = $records;
        $enregistrement = "";
        $response = "";
        $ValueRecupZone = "";
        $tabEnregistrement = array();

        if ($type == 'enregistrements a') {
            //Type line est une variable qui va permettre de savoir si c'est une ligne contenant le nom ou l'
            $tabName = array();
            $tabIp = array();
            $lastLine = "";
            SSH::run("./api/dns/a/records", function ($line) use (&$response, &$tabName, &$tabIp, &$lastLine) {
                if ($line[0] == "N") {
                    $name = explode("=", explode(",", $line)[0])[1];

                    array_push($tabName, $name);
                } else {

                    $ip = explode(":", explode("(", $line)[0])[1];

                    if (strpos($lastLine, "A:") !== false) {
                        $tabIp[sizeof($tabIp) - 1] .= ", $ip";
                    } else {
                        array_push($tabIp, $ip);
                    }
                }
                $lastLine = $line;
            });
            for ($i = 1; $i < sizeof($tabIp); $i++) {
                $htSp = "htmlspecialchars";

                $response .= <<<DEL
                    <tr>
                        <td class="text-center">{$htSp($i)}</td>
                        <td>{$tabName[$i]}</td>
                        <td>{$tabIp[$i]}</td>
                        <td class="td-actions text-left">
                            <a href="/dns/edit/{$tabName[$i]}--{$tabIp[$i]}" class="btn btn-success btn-round">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="/dns/delete/{$tabName[$i]}--{$tabIp[$i]}" class="btn btn-danger btn-round">
                                <i class="material-icons">close</i>
                            </a>
                        </td>
                    </tr>
                DEL;
            }

            $tabEnregistrement = array_combine($tabName, $tabIp);
            array_shift($tabEnregistrement);
        }
        if ($type == "zone") {
            $RecupZone = "";

            SSH::run("./api/dns/zones", function ($line) use (&$RecupZone) {
                $RecupZone .= $line . "<br >";
                $RecupZone = substr("$line", -60);
                $RecupZone = substr("$line", 60);


            });



            $ValueRecupZone .= $RecupZone; //substr($TabZone[22], 14, 23)."<br>";


        }

        if ($type == "enregistrements cname") {
            $tabNameCname = array();
            $tabCname = array();
            $lastLineCname = "";


            SSH::run("./api/dns/cname/records", function ($line) use (&$responseCname, &$tabNameCname, &$tabCname, &$lastLineCname) {
                // $response .= $line . "<br />";

                if ($line[0] == "N") {
                    $name = explode("=", explode(",", $line)[0])[1];

                    array_push($tabNameCname, $name);
                } else {

                    $Cname = explode(":", explode("(", $line)[0])[1];

                    if (strpos($lastLineCname, "CNAME:") !== false) {
                        $tabCname[sizeof($tabCname) - 1] .= ", $Cname";
                    } else {
                        array_push($tabCname, $Cname);
                    }
                }
                $lastLineCname = $line;
            });

            $tabEnregistrement = array_combine($tabNameCname, $tabCname);
        }

        return view('dns.dns-list', [
            'tabEnregistrement' => $tabEnregistrement,
            'type' => $type,
            'RecupZone' => $ValueRecupZone
        ]);
    }



    public function update(Request $request)
    {
        $type = $request->get('type');

        $name = $request->get('name');
        $lastElement = $request->get('lastElement');

        if ($type == "a") {

            $ip = $request->get('ip');
            SSH::run("./api/dns/a/update $name $lastElement $ip");
        } else if ($type == "cname") {

            $cname = $request->get('cnamu');
            SSH::run("./api/dns/cname/update $name $lastElement $cname");
        }

        return view('dns.dns-list');
    }

    public function delete($name)
    {
        $tabNom = explode("--", $name);
        $nom = $tabNom[0];
        $ip = $tabNom[1];
        SSH::run("./api/dns/a/delete $nom $ip");

        return view('dns.dns-list');
    }


    public function createdata(Request $request)
    {
        $name = $request->input('name');
        $ip = $request->input('ip');
        $alias = $request->input('cname');
        $message = $name;
        $result = "";

        if (isset($alias)) {
            SSH::run("./api/dns/cname/add " . $name . " " . $alias, function ($line) use (&$response, &$message) {
                $response .= $line;
                if (substr($response, 0, 5) == 'ERROR') {
                    $message = "Une erreur est survenu lors de l'ajout d'un enregistrement !";
                } else {
                    $message = "Enregistrement réussi !";
                }
            });
            $type = $alias;
        } else if (isset($ip)) {
            SSH::run("./api/dns/a/add " . $name . " " . $ip, function ($line) use (&$response, &$message) {
                $response .= $line;
                if (substr($response, 0, 5) == 'ERROR') {
                    $message = "Une erreur est survenu lors de l'ajout d'un enregistrement !";
                } else {
                    $message = "Enregistrement réussi !";
                }
            });
            $type = $ip;
        } else {
            $message = "Erreur dans la recup des informations";
        }

        return view('dns.dns-list', ['nameDns' => $name, 'result' => $result, 'resultat' => $message]);
    }
}
