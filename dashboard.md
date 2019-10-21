# BREW - Latest ELK (Logstash Elastic Kibana)
## Installation
```shell script
   brew tap elastic/tap && brew install elastic/tap/kibana-full
```

## Starting Services
```shell script
   brew services start logstash && brew services start elasticsearch && brew services start kibana
```

# BREW - Stable ELK (Logstash Elastic Kibana)
## Installation
```shell script
    brew cask install homebrew/cask-versions/adoptopenjdk8 && brew install logstash && brew install elasticsearch && brew install kibana
```

## Starting Services
```shell script
   brew services start logstash && brew services start elasticsearch && brew services start kibana
```

## Checking Services

```shell script
    $ brew services list
```

## Running Services

#### Logstash

1. Setup driver (can change it at .conf in lib/dashboards)

    ```shell script
        $ cp resources/mysql-connector-java-5.1.47-bin.jar /db_drivers
    ```    

1. Setup endpoint

    ```shell script
        $ /usr/local/Cellar/logstash/version/bin/logstash -f pbci_projects.conf
    ```

1. Stop logstash (__if got error or died__): ^C (2x) --> Ctrl+C (2x)


1. Kill logstash processes

    ```shell script
        $ killall logstash
    ```

#### Elastic Search

1. Check logstash data in elastic search endpoint (default limit(size)=10)

    ```shell script
        $  curl 'http://localhost:9200/projects/_search?size=1000&pretty=true'
    ```

#### Kibana

1. Check kibana dashboard

    ```shell script
        $  curl 'http://localhost:9200/projects/_search?size=1000&pretty=true'
    ```


3. Java MySQL Driver
    1. Download (JAR): http://www.java2s.com/Code/Jar/m/Downloadmysqlconnectorjava5123binjar.htm




RUN LOGSTASH
$ /usr/local/Cellar/logstash/6.4.2/bin/logstash -f


CONFIG LOGSTASH
$ cd /usr/local/Cellar/logstash/6.4.2/libexec/config
$ sudo atom .
Alterações:
1. logstash.conf
    1. O que colocar neste arquivo em input para conectar ao mysql
        1. OFICIAL: https://www.elastic.co/guide/en/logstash/current/plugins-inputs-jdbc.html
        2. GRUPO: https://discuss.elastic.co/t/how-to-connect-mysql-database-by-logstash/61004/3
2.
￼




CONFIG ELASTIC
$

CONFIG KIBANA
$ sudo nano /usr/local/etc/kibana/kibana.yml

server.port: 5601
elasticsearch.url: "http://localhost:9200”



Logstash conf sample

input {
  jdbc {
    jdbc_driver_library => "mysql-connector-java-5.1.36-bin.jar"
    jdbc_driver_class => "com.mysql.jdbc.Driver"
    jdbc_connection_string => "jdbc:mysql://localhost:3306/pbci_development"
    jdbc_user => "root"
    parameters => { "favorite_artist" => "Beethoven" }
    schedule => "* * * * *"
    statement => "SELECT * from pbci_development.projects" #where artist = :favorite_artist
    use_column_value => true
    tracking_column => "id"
  }
}

output {
  elasticsearch {
    hosts => ["http://localhost:9200"]
    index => "%{[@metadata][beat]}-%{[@metadata][version]}-%{+YYYY.MM.dd}"
    #user => "elastic"
    #password => "changeme"
  }
  stdout { codec => rubydebug }
}
