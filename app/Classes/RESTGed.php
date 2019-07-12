<?php


namespace App\Classes;


class RESTGed {

    /**
     * The system url
     * @var string
     */
    private $URL_BASE = "";

    /**
     * The user id to make requests
     * @var int
     */
    private $USER_ID = 0;

    /**
     * The access token
     * @var string
     */
    private $TOKEN = "";

    /**
     * The http object to make requests
     * @var RESTServices
     */
    private $REST;



    /**
     * @return string
     */
    public function getURLBASE(): string {
        return $this->URL_BASE;
    }

    /**
     * @param string $URL_BASE
     */
    public function setURLBASE(string $URL_BASE): void {
        $this->URL_BASE = $URL_BASE;
    }

    /**
     * @return int
     */
    public function getUSERID(): int {
        return $this->USER_ID;
    }

    /**
     * @param int $USER_ID
     */
    public function setUSERID(int $USER_ID): void {
        $this->USER_ID = $USER_ID;
    }

    /**
     * @return string
     */
    public function getTOKEN(): string {
        return $this->TOKEN;
    }

    /**
     * @param string $TOKEN
     */
    public function setTOKEN(string $TOKEN): void {
        $this->TOKEN = $TOKEN;
    }



    /**
     * RESTGed constructor.
     * @param string $_urlBase
     * @param string $_userID
     * @param string $_token
     */
    public function __construct($_urlBase = "", $_userID = "", $_token = "") {
        if( !is_null($_urlBase) )   $this->URL_BASE = $_urlBase;
        if( !is_null($_userID) )    $this->USER_ID  = $_userID;
        if( !is_null($_token) )     $this->TOKEN    = $_token;

        $this->REST = new RESTServices();
    }


    public function appendTokenHeader() {
        return [
            'headers' => [
                'Cookie: ' => 'CXSSID=' . $this->getTOKEN()
            ]
        ];
    }






    /**
     * AREAS
     */

    /**
     * Pesquisa uma área a partir do seu ID.
     * @param string $_idArea           O ID da área que será consultada.
     * @param bool $_filhas             Incluir áreas filhas.
     * @return JSON
     */
    public function getArea($_idArea = "", string $_filhas = "false") {
        $tree = $this->REST->get($this->getURLBASE() . "/area/" . $_idArea, $this->appendTokenHeader(), [
            'filhas'  => $_filhas,
        ]);

        return $tree;
    }







    /**
     * REGISTERS
     */

    public function getRegisters($_listaIdsAreas, $_listaIndices, $_extras) {
        $arr = array();
        foreach ($_listaIndices as $key => $elemento) {
            $arr[$key] = $elemento;
        }


        $body = [
            "listaIdArea" => $_listaIdsAreas,
            "listaIndice" => $arr
        ];

        foreach ($_extras as $key => $value) {
            $body[$key] = $value;
        }


        $registros = $this->REST->post($this->getURLBASE() . "/registro/pesquisa", $body);
        return $registros;
    }


    /**
     * Pesquisa um registro a partir do seu ID.
     * @param string $_idRegistro       O ID do registro que será consultado
     * @param bool $_docs               Incluir documentos do registro.
     * @param bool $_bytes              Incluir conteúdos dos documentos do registro.
     * @return JSON
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRegister(string $_idRegistro, string $_docs = 'true', string $_bytes = 'false') {
        $registroCompletoWS = $this->REST->get($this->getURLBASE() . "/registro/" . $_idRegistro, $this->appendTokenHeader(), [
            'docs'  => $_docs,
            'bytes' => $_bytes,
        ]);

        return $registroCompletoWS;
    }


    /**
     * Insere um registro no sistema, considerando os Índices e Documentos passados. A lista de Documentos é opcional, e se não forem passados Índices, apenas os de sistema serão preenchidos.
     * Caso algum dos Índices seja obrigatório, a operação retornará erro.
     *
     * Corpo da requisição: ​ RegistroCompletoWS​ (application/json)
     * Retorno: ID do registro inserido (text/plain)
     */
    public function createRegister(string $_idArea, int $_idUsuario, array $_listaIndices = [], array $_listaDocumento = []) {
        $idRegistroInserido = $this->REST->post($this->getURLBASE() . "/registro/", [
            "idArea"            => $_idArea,
            "idUsuario"         => $_idUsuario,
            "listaIndice"       => $_listaIndices,
            "listaDocumento"    => $_listaDocumento
        ]);

        return $idRegistroInserido;
    }


    public function updateRegister() {
        
    }


    public function removeRegister(string $_idRegistro) {
        $response = $this->REST->delete($this->getURLBASE() . "/registro/" . $_idRegistro, $this->appendTokenHeader());
        return $response->getStatusCode();
    }



    /**
     * DOCUMENTS
     */
    public function getDocument(string $_idDocumento, string $_bytes = 'false') {
        $documentoCompletoWS = $this->REST->get($this->getURLBASE() . "/documento/" . $_idDocumento, $this->appendTokenHeader(), [
            'bytes' => $_bytes,
        ]);

        return $documentoCompletoWS;
    }


    public function updateDocument(array $_props, array $_listaIndices = []) {
        $_props['listaIndice'] = $_listaIndices;

        $documentoCompletoWS = $this->REST->put($this->getURLBASE() . "/documento", $_props);

        return $documentoCompletoWS;
    }


    public function removeDocument(string $_idDocumento) {
        $response = $this->REST->delete($this->getURLBASE() . "/documento/" . $_idDocumento, $this->appendTokenHeader());
        return $response->getStatusCode();
    }


    

}