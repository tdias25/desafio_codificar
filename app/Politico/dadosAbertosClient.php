<?php

namespace App\Politico;

use App\Helpers\curlHelper;

class dadosAbertosClient {

	/**
     * URL base padrao do webservice
     *
     * @var string
     */

	private $base_endpoint = 'http://dadosabertos.almg.gov.br/ws/';

	/**
     * inicializa as variaveis e define parametros que serao usados na requisicao
     *
     * @return void
     */
	function __construct()
	{
		$this->request = new curlHelper();
		$this->request->setMethod('GET');
		$this->request->setHeader('Content-Type: application/json');
		$this->request->setParam('formato', 'json');
	}

	/**
     * envia requisicao usando metodos do curlHelper
     *
     * @return array
     */
	function enviaRequisicao($caminho, $arrayFormat = true) 
	{
		$this->request->setUrl($this->base_endpoint . $caminho);

		$resposta = $this->request->send();

		if(strlen($resposta) <= 0)
			throw new \Exception("Erro na requisicao");

		return json_decode($resposta, $arrayFormat);
	}

	/**
     * lista informações dos deputados em exercicio
     *
     * @return array
     */
	function listaDeputados() 
	{
		$caminho = 'deputados/em_exercicio?';
		$resposta = $this->enviaRequisicao($caminho);

		return $resposta['list'];
	}

	/**
     * lista verbas indenizatorias por deputado, ano e mes
     *
     * @return array
     */
	function listaVerbasIndenizatorias($deputado_id, $ano, $mes)
	{

		$caminho = "prestacao_contas/verbas_indenizatorias/deputados/{$deputado_id}/{$ano}/{$mes}";
		$resposta = $this->enviaRequisicao($caminho);

		return $resposta['list'];
	}

	/**
     * lista deputados por legislatura
     * o valor 18 foi o escolhido por ser o periodo em que o ano 2017 se encontra
     * @return array
     */
	function listaDeputadosPorLegislatura($legislatura = 18) 
	{

		$caminho = "legislaturas/pesquisa_deputados?";

		$this->request->setParam('nome', '');
		$this->request->setParam('leg', $legislatura);

		$resposta = $this->enviaRequisicao($caminho);

		return $resposta['list'][0]['lista'];
	}
}