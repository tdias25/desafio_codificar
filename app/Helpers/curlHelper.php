<?php

namespace App\Helpers;

class curlHelper 
{
	private $url;
	private $params = array();
	private $methods = array('POST', 'GET');
	private $method;
	private $headers = array();	

	function __construct($url = false)
	{	
		if($url)
			$this->setUrl($url);
	}

	/**
     * define a URL que sera enviada a requisicao
     *
     * @return void
     */

	function setUrl($url) {
		$this->url = $url;
	}

	/**
     * define o metodo HTTP que sera usado na requisicao, somente GET e POST sao aceitos
     *
     * @return void
     */

	function setMethod($method)
	{

		if(!in_array($method, $this->methods))
			throw new Exception("Metodo Invalido");

		$this->method = $method;
	}

	/**
     * define os parametros que sao usados na requisicao, adicionando chaves-valores a propriedade $params
     *
     * @return void
     */

	function setParam($param, $value) {
		$this->params[$param] = $value;
	}

	/**
     * retorna um valor ou array com todos os parametros definidos
     *
     * @return array
     */

	function getParams($param = false) {

		if($param)
			return $this->params[$param];

		return $this->params;
	}

	/**
     * define valor de cabecalho HTTP a ser enviado na requisicao, adicionando uma string a propriedade 
     $headers
     *
     * @return void
     */

     function setHeader($header) {
     	array_push($this->headers, $header);
     }

	/**
     * envia uma requisicao HTTP
     *
     * @return string
     */

	function send() {

		$ch = curl_init();

		if($this->method == 'GET')
			$url = $this->url . '?' . http_build_query($this->params);
		else
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		curl_close ($ch);

		return $response;
	}

}