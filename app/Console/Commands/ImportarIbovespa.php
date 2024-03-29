<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CarteirasImport;
use App\Imports\ExcelUtils;
use Maatwebsite\Excel\HeadingRowImport;
use App\Carteira;
use App\Corretora;
use App\Empresa;
use App\Ibovespa;
use App\Cdi;
use App\Ipca;
use DB;

class ImportarIbovespa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportarIbovespa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa Ibovespa xlsx';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = public_path('ipca.xlsx');
        $Import = new ExcelUtils();
        $ts = \Maatwebsite\Excel\Facades\Excel::import($Import, $file);
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );
        foreach ($Import->sheetData as $data) {
            foreach($data as $data){
                if(isset($data['Ano']) && isset($data['Mes'])){
                  $retorno = Ipca::firstOrCreate([
                    'ano'=>$data['Ano'],
                    'mes'=>$data['Mes']
                ],
                [
                    'retorno_mensal'=>$data['Retorno'],
                ]); 
              }
          }

        }
        return ;
    }

    public function converteMes($mes){
        switch($mes) {
            case 'Janeiro':
            return 1;
            break;
            case 'Fevereiro':
            return 2;            
            break;
            case 'Marco':
            return 3;            
            break;
            case 'Março':
            return 3;            
            break;
            case 'Abril':
            return 4;            
            break;
            case 'Maio':
            return 5;            
            break;
            case 'Junho':
            return 6;
            break;
            case 'Julho':
            return 7;            
            break;
            case 'Agosto':
            return 8;
            break;
            case 'Setembro':
            return 9;
            break;
            case 'Outubro':
            return 10;
            break;
            case 'Novembro':
            return 11;
            break;
            case 'Dezembro':
            return 12;
            break;
        }
    }
    public function tirarAcentos($text) {
        $utf8 = array(
            '/[áàâãªäāẵ]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/&/'           =>   'e',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            "/'/"           =>   '',
            '/"/'           =>   '',
        '/º/'           =>   '', // UTF-8 hyphen to "normal" hyphen
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
        $string = preg_replace(array_keys($utf8), array_values($utf8), $text);
        $string = preg_replace('/[^A-Za-z0-9 \-]/', '', $string);

        return $string;
    }
}
