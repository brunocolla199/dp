

## CONFIGURAÇÕES - FILA DE E-MAILS

Para o envio de e-mails, a aplicação adota filas de processos utilizando o bando de dados, ou seja, toda vez que um e-mail precisar ser enviado, ele ficara em fila em uma tabela `jobs` no banco de dados, caso houver algum erro ou problema com o processo de envio, esse processo será repetido 3 vezes, se mesmo assim não for possível concluir com sucesso o processo, o mesmo é movido para uma tabela `failed_jobs`, onde ser possível analisar os dados e identificar o erro que não permite a conclusão do processo.
Para disparar e-mails utilizando filas:

1 - importar o job

    use App\Jobs\SendEmailsJob;

2 - utilize o seguinte trecho de código:

    $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, $documento[0], $responsavelPelaAcao[0], $tipo, $assunto));


* verificar se o arquivo `.env` possui a seguinte propriedade

        QUEUE_DRIVER=database


## EXECUÇÃO

Para que os emails que estão em fila sejam executados, é necessário que algum processo do servidor fique monitorando a fila, para isso, é preciso observar qual o ambiente que a aplicação está sendo executada. 

### EXECUÇÃO LOCALHOST

para executar no ambiente local, é necessário manter o processo de fila sendo executado, caso contrário os e-mails ficarão em fila e não serão enviados.
para isso execute o seguinte comando no terminal:

    php artisan queue:work --daemon --sleep=3 --tries=3

### EXECUÇÃO PRODUÇÃO

para executar em modo de produção, é necessário configurar um supervisor, para você deve que seguir os passos conforme descrito na própria documentaçao do laravel disponível em [Doc-Supervisor](https://laravel.com/docs/5.5/queues#supervisor-configuration)


