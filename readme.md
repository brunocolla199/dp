

## CONFIGURAÇÕES - FILA DE E-MAILS

Para o envio de e-mails, a aplicação adota filas de processos utilizando o banco de dados, ou seja, toda vez que um e-mail precisar ser enviado, ele ficara em fila em uma tabela `jobs` no banco de dados, caso houver algum erro ou problema com o processo de envio, esse processo será repetido 3 vezes, se mesmo assim não for possível concluir com sucesso o processo, o mesmo é movido para uma tabela `failed_jobs`, onde será possível analisar os dados e identificar o que não permite a conclusão do processo.
Para disparar e-mails utilizando filas:

1 - Importar o job

    use App\Jobs\SendEmailsJob;

2 - Utilize o seguinte trecho de código:

    $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, $documento[0], $responsavelPelaAcao[0], $tipo, $assunto));


* verificar se o arquivo `.env` possuí a seguinte propriedade

        QUEUE_DRIVER=database


## EXECUÇÃO

Para que os emails que estão em fila sejam executados, é necessário que algum processo do servidor fique monitorando a fila, para isso, é preciso observar qual o ambiente que a aplicação está sendo executada. 

### EXECUÇÃO LOCALHOST

Para executar no ambiente local, é necessário manter o processo de fila sendo executado, caso contrário os e-mails ficarão em fila e não serão enviados.
Para isso execute o seguinte comando no terminal:

    php artisan queue:work --daemon --sleep=3 --tries=3

### EXECUÇÃO PRODUÇÃO

Para executar em modo de produção, é necessário configurar um `supervisor`, para isso você deve que seguir os passos conforme descrito na própria documentaçao do laravel disponível em [Doc-Supervisor](https://laravel.com/docs/5.5/queues#supervisor-configuration)

    1.  easy_install supervisor
    2.  apt-get install supervisor
    3.  apt-get update
    4.  cd /etc/supervisor/conf.d/
    5.  ls
    6.  nano laravel-worker.conf

            [program:laravel-worker]
            process_name=%(program_name)s_%(process_num)02d
            command=php /home/ubuntu/dpworld-qualidade/artisan queue:work --daemon --sleep=3 --tries=3
            user=root
            autostart=true
            autorestart=true
            numprocs=10
            redirect_stderr=true
            stdout_logfile=/home/ubuntu/dpworld-qualidade/laravel-queue-worker.log
    
    7.   service supervisor restart
    8.   cd ..
    9.   chmod -R 777 *
    10.  sudo supervisorctl reread
    11.  sudo supervisorctl update
    12.  sudo supervisorctl start laravel-worker:*



**NOTE:** Rodar _php artisan migrate_
