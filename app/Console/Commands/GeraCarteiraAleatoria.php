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

class GeraCarteiraAleatoria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GeraCarteiraAleatoria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera Carteira Aleatoria';

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
        $corretora = Corretora::where('nome', 'ALEATORIA')->first();
        if(empty($corretora)){
            $corretora = Corretora::create([
                'nome'=>'ALEATORIA'
            ]);
        }
        $carteirasExistentes = Carteira::where('corretora_id','!=', $corretora->id)->groupBy('mes','ano')->get();
        foreach ($carteirasExistentes as $carteira){
            $ativos = Carteira::where('mes', $carteira->mes)->where('ano',$carteira->ano)->get();
            dump($carteira->mes, $carteira->ano);
            if($ativos->where('corretora_id', $corretora->id)->count() == 0){
                $ativos = $ativos->pluck('ativo_id')->toArray();
                $i = 1;
                while ($i <= 5) {
                    $ativoAleatorio = array_rand($ativos, 1);
                    $ativoNaCarteira = Carteira::where('mes', $carteira->mes)
                    ->where('ano',$carteira->ano)
                    ->where('ativo_id',$ativos[$ativoAleatorio])
                    ->where('corretora_id',$corretora->id)
                    ->first();
                    if(empty($ativoNaCarteira)){
                        Carteira::create([
                            'mes' => $carteira->mes,
                            'ano'=>$carteira->ano,
                            'ativo_id'=>$ativos[$ativoAleatorio],
                            'corretora_id'=>$corretora->id
                        ]);
                        $i++;
                    }                
                }
            }
        }

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
