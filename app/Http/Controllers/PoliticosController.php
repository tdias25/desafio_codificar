<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Politico\dadosAbertosClient;

use App\Models\Deputado;
use App\Models\VerbaIndenizatoria;
use App\Models\VerbaIndenizatoria\Despesa as VerbaDespesa;


class PoliticosController extends Controller
{
	/**
     * lista todos os deputados do webservice e verifica se ja existe no banco de dados, senao existir
     * as informacoes do deputado sao salvas no banco de dados
     *
     * @return void
     */

	function set_deputados() {

		try {

			$dadosAbertosClient = new dadosAbertosClient;

			$listaDeputados = $dadosAbertosClient->listaDeputadosPorLegislatura();

			foreach ($listaDeputados as $deputado) {

				$deputado = Deputado::findById($deputado['id']);	

				if($deputado)
					continue;

				$deputadoData = [
					'id_deputado' => $deputado->id,
					'nome' => $deputado->nome,
					'partido' => $deputado->partido,
					'tag_localizacao' => $deputado->tagLocalizacao
				];

				Deputado::create($deputadoData);
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	/**
     * faz uma iteracao com todos os deputados salvos no banco de dados e os meses do ano de 2017 enviando uma 
     * requisicao ao webservice para popular o banco de dados com todas as verbas indenizatorias e suas despesas
     *
     * @return void
     */

	function set_verbas () {

		try {

			$dadosAbertosClient = new dadosAbertosClient;
			$deputados = Deputado::all();

			foreach ($deputados as $deputado):

				for ($mes=1; $mes <= 12 ; $mes++) {

					$listaVerbas = $dadosAbertosClient->listaVerbasIndenizatorias($deputado->id_deputado, 2017, $mes);

					foreach ($listaVerbas as $verbaIndenizatoria) {

						$verbaIndenizatoriaData = [
							'id_deputado' => $verbaIndenizatoria['idDeputado'],
							'data_referencia' => $verbaIndenizatoria['dataReferencia']['$'],
							'cod_tipo_despesa' => $verbaIndenizatoria['codTipoDespesa'],
							'valor' => $verbaIndenizatoria['valor'],
							'descricao_tipo_despesa' => $verbaIndenizatoria['descTipoDespesa']
						];

						$createVerba = VerbaIndenizatoria::create($verbaIndenizatoriaData);

						if(empty($verbaIndenizatoria['listaDetalheVerba']))
							continue;

						foreach ($verbaIndenizatoria['listaDetalheVerba'] as $despesaDetalhada) {

							$despesaDetalhadaData = [
								'id_item' => $despesaDetalhada['id'],
								'valor_reembolsado' => $despesaDetalhada['valorReembolsado'],
								'data_emissao' => $despesaDetalhada['dataEmissao']['$'],
								'cpf_cnpj' => $despesaDetalhada['cpfCnpj'],
								'valor_despesa' => $despesaDetalhada['valorDespesa'],
								'nome_emitente' => $despesaDetalhada['nomeEmitente'],
								'descricao_documento' => @$despesaDetalhada['descDocumento'],
								'descricao_tipo_despesa' => $despesaDetalhada['descTipoDespesa']
							];

							$createVerba->itens()->create($despesaDetalhadaData);
						}

					}
					// a API recomenda um intervalo de 1 segundos entre as requisicoes, mas por precaucao coloquei 5 segundos
					sleep(5);

				}

			endforeach;

		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	function set_midias_sociais () {


	}
}
