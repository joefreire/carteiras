<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticker');
            $table->string('nome')->nullable();
            $table->string('site')->nullable();
            $table->string('setor')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
        });

        //DB::table('empresas')->insertUsing(['ticker','nome','setor','tipo', 'site'], $insert);
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ABEV3','AMBEV S/A','Consumo não Cíclico / Bebidas / Cervejas e Refrigerantes','ON','http://ri.ambev.com.br')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('AZUL4','AZUL','Bens Industriais / Transporte / Transporte Aéreo','PN N2','https://www.voeazul.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('B3SA3','B3','Financeiro e Outros / Serviços Financeiros Diversos / Serviços Financeiros Diversos','ON NM','http://www.b3.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BBAS3','BANCO DO BRASIL','Financeiro e Outros / Intermediários Financeiros / Bancos','ON ERJ NM','http://www.bb.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BBDC3','BRADESCO','Financeiro e Outros / Intermediários Financeiros / Bancos','ON N1','http://www.bradesco.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BBDC4','BRADESCO','Financeiro e Outros / Intermediários Financeiros / Bancos','PN N1','http://www.bradesco.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BBSE3','BBSEGURIDADE','Financeiro e Outros / Previdência e Seguros / Seguradoras','ON NM','http://www.bantickerobrasilseguridade.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BEEF3','MINERVA','Consumo não Cíclico / Alimentos Processados / Carnes e Derivados','ON NM','http://www.minervafoods.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BPAC11','BTGP BANCO','Financeiro e Outros / Intermediários Financeiros / Bancos','UNT N2','http://ri.btgpactual.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BRAP4','BRADESPAR','Materiais Básicos / Mineração / Minerais Metálicos','PN N1','http://www.bradespar.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BRDT3','PETROBRAS BR','Petróleo. Gás e Biocombustíveis','ON NM','http://www.br.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BRFS3','BRF SA','Consumo não Cíclico / Alimentos Processados / Carnes e Derivados','ON NM','http://www.brf-br.com')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BRKM5','BRASKEM','Materiais Básicos / Químicos / Petroquímicos','PNA N1','http://www.braskem.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BRML3','BR MALLS PAR','Financeiro e Outros / Exploração de Imóveis','ON NM','http://www.brmalls.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('BTOW3','B2W DIGITAL','Consumo Cíclico / Comércio','ON ES NM','https://ri.b2w.digital/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CCRO3','CCR SA','Bens Industriais / Transporte / Exploração de Rodovias','ON NM','http://www.grupoccr.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CIEL3','CIELO','Financeiro e Outros / Serviços Financeiros Diversos / Serviços Financeiros Diversos','ON NM','http://ri.cielo.com.br')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CMIG4','CEMIG','Utilidade Pública / Energia Elétrica','PN N1','http://ri.cemig.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('COGN3','COGNA ON','Consumo Cíclico / Diversos / Serviços Educacionais','ON NM','http://ri.cogna.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CPFE3','CPFL ENERGIA','Utilidade Pública / Energia Elétrica / Energia Elétrica','ON NM','https://cpfl.riweb.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CRFB3','CARREFOUR BR','Consumo não Cíclico / Comércio e Distribuição / Alimentos','ON NM','https://www.grupocarrefourbrasil.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CSAN3','COSAN','Petróleo. Gás e Biocombustíveis','ON NM','http://ri.cosan.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CSNA3','SID NACIONAL','Materiais Básicos / Siderurgia e Metalurgia / Siderurgia','ON','http://ri.csn.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CVCB3','CVC BRASIL','Consumo Cíclico / Viagens e Lazer / Viagens e Turismo','ON NM','https://www.cvc.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('CYRE3','CYRELA REALT','Consumo Cíclico / Construção Civil / Edificações','ON NM','http://www.cyrela.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ECOR3','ECORODOVIAS','Bens Industriais / Transporte / Exploração de Rodovias','ON NM','http://www.ecorodovias.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('EGIE3','ENGIE BRASIL','Utilidade Pública / Energia Elétrica','ON NM','https://www.engie.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ELET3','ELETROBRAS','Utilidade Pública / Energia Elétrica','ON N1','http://eletrobras.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ELET6','ELETROBRAS','Utilidade Pública / Energia Elétrica','PNB N1','http://eletrobras.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('EMBR3','EMBRAER','Bens Industriais / Material de Transporte','ON NM','https://embraer.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ENBR3','ENERGIAS BR','Utilidade Pública / Energia Elétrica','ON NM','http://www.edp.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ENGI11','ENERGISA','Utilidade Pública / Energia Elétrica','UNT N2','http://grupoenergisa.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('EQTL3','EQUATORIAL','Utilidade Pública / Energia Elétrica','ON NM','http://www.equatorialenergia.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('FLRY3','FLEURY','Saúde / Serv.Méd.Hospit..Análises e Diagnósticos','ON NM','http://www.fleury.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('GGBR4','GERDAU','Materiais Básicos / Siderurgia e Metalurgia / Siderurgia','PN N1','https://www.gerdau.com/br/pt/home')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('GNDI3','INTERMEDICA','Saúde / Serv.Méd.Hospit..Análises e Diagnósticos','ON NM','https://ri.gndi.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('GOAU4','GERDAU MET','Materiais Básicos / Siderurgia e Metalurgia / Siderurgia','PN N1','https://www.gerdau.com/br/pt/home')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('GOLL4','GOL','Bens Industriais / Transporte / Transporte Aéreo','PN ES N2','https://www.voegol.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('HAPV3','HAPVIDA','Saúde / Serv.Méd.Hospit..Análises e Diagnósticos','ON ED NM','https://www.hapvida.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('HGTX3','CIA HERING','Consumo Cíclico / Tecidos. Vestuário e Calçados / Vestuário','ON NM','https://ciahering.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('HYPE3','HYPERA','Saúde / Comércio e Distribuição','ON NM','https://hyperapharma.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('IGTA3','IGUATEMI','Financeiro e Outros / Exploração de Imóveis','ON NM','https://iguatemi.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('IRBR3','IRBBRASIL RE','Financeiro / Previdência e Seguros / Seguradoras','ON NM','https://www.irbre.com')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ITSA4','ITAUSA','Financeiro e Outros / Intermediários Financeiros / Bancos','PN N1','http://www.itausa.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('ITUB4','ITAUUNIBANCO','Financeiro e Outros / Intermediários Financeiros / Bancos','PN N1','https://www.itau.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('JBSS3','JBS','Consumo não Cíclico / Alimentos Processados / Carnes e Derivados','ON NM','https://jbs.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('KLBN11','KLABIN S/A','Materiais Básicos / Papel e Celulose','UNT N2','https://www.klabin.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('LAME4','LOJAS AMERIC','Consumo Cíclico / Comércio','PN N1','https://www.americanas.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('LREN3','LOJAS RENNER','Consumo Cíclico / Comércio','ON NM','https://www.lojasrenner.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('MGLU3','MAGAZ LUIZA','Consumo Cíclico / Comércio','ON NM','https://www.magazineluiza.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('MRFG3','MARFRIG','Consumo não Cíclico / Alimentos Processados / Carnes e Derivados','ON NM','http://www.marfrig.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('MRVE3','MRV','Consumo Cíclico / Construção Civil / Edificações','ON NM','https://www.mrv.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('MULT3','MULTIPLAN','Financeiro e Outros / Exploração de Imóveis','ON N2','http://multiplan.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('NTCO3','NATURA','Consumo não Cíclico / Produtos de Uso Pessoal e de Limpeza','ON NM','https://www.natura.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('PCAR3','P.ACUCAR-CBD','Consumo não Cíclico / Comércio e Distribuição / Alimentos','ON ED NM','https://www.paodeacucar.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('PETR3','PETROBRAS','Petróleo. Gás e Biocombustíveis','ON N2','http://www.petrobras.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('PETR4','PETROBRAS','Petróleo. Gás e Biocombustíveis','PN N2','http://www.petrobras.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('QUAL3','QUALICORP','Saúde / Serv.Méd.Hospit..Análises e Diagnósticos','ON NM','https://www.qualicorp.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('RADL3','RAIADROGASIL','Saúde / Comércio e Distribuição','ON NM','https://www.rd.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('RAIL3','RUMO S.A.','Bens Industriais / Transporte / Transporte Ferroviário','ON NM','http://rumolog.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('RENT3','LOCALIZA','Consumo Cíclico / Aluguel de carros','ON NM','https://www.localizahertz.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('SANB11','SANTANDER BR','Financeiro e Outros / Intermediários Financeiros / Bancos','UNT','https://www.santander.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('SBSP3','SABESP','Utilidade Pública / Água e Saneamento','ON NM','http://sabesp.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('SULA11','SUL AMERICA','Financeiro / Previdência e Seguros / Seguradoras','UNT N2','https://ri.sulamerica.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('SUZB3','SUZANO S.A.','Materiais Básicos / Papel e Celulose','ON NM','http://www.suzano.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('TAEE11','TAESA','Utilidade Pública / Energia Elétrica','UNT N2','http://www.taesa.com.br')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('TIMP3','TIM PART S/A','Telecomunicações','ON NM','https://www.tim.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('TOTS3','TOTVS','Tecnologia da Informação / Programas e Serviços','ON EDB NM','https://www.totvs.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('UGPA3','ULTRAPAR','Petróleo. Gás e Biocombustíveis','ON ED NM','http://www.ultra.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('USIM5','USIMINAS','Materiais Básicos / Siderurgia e Metalurgia / Siderurgia','PNA N1','https://www.usiminas.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('VALE3','VALE','Materiais Básicos / Mineração / Minerais Metálicos','ON NM','http://www.vale.com/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('VIVT4','TELEF BRASIL','Telecomunicações','PN','http://www.telefonica.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('VVAR3','VIAVAREJO','Consumo Cíclico / Comércio','ON NM','https://www.viavarejo.com.br/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('WEGE3','WEG','Bens Industriais / Máquinas e Equipamentos','ON NM','https://www.weg.net/')");
        DB::statement("INSERT INTO empresas(ticker,nome,setor,tipo,site) VALUES ('YDUQ3','YDUQS PART','Consumo Cíclico / Serviços Educacionais','ON NM','https://www.yduqs.com.br/')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
