# ELK Kibana-full BREW
ELK Kibana Full brew usage

## Add Hosts
move hosts-sample to /etc/hosts

## Installing ELK
1. Update ELK package:
  ```shellscript
    $ brew tap elastic/tap
  ```
1. Install logstash:
  ```shellscript
    $ brew install elastic/tap/logstash-full
  ```  
1. Install elasticsearch:
  ```shellscript
    $ brew install elastic/tap/elasticsearch-full
  ```  
1. Install kibana:
  ```shellscript
    $ brew install elastic/tap/kibana-full
  ```  

## Start all services

```shellscript
  $ brew services start logstash-full && brew services start elasticsearch-full && brew services start kibana-full
```

## Config Logstash

1. Setup driver (can change it at .conf in sample-files/projects_mysql.conf)
  ```shell script
      $ sudo mkdir /db_drivers && cp resources/mysql-connector-java-5.1.47-bin.jar /db_drivers
  ```
1. Setup endpoint MYSQL request
  ```shell script
      $ /usr/local/Cellar/logstash-full/7.4.0/bin/logstash -f sample-files/projects_mysql.conf
  ```
1. Install logstash HTTP dependency:
  ```shell script
    $ /usr/local/Cellar/logstash-full/7.4.0/bin/logstash-plugin install logstash-input-http_poller
  ```
1. Setup endpoint PHP JSON request
  ```shell script
      $ /usr/local/Cellar/logstash-full/7.4.0/bin/logstash -f sample-files/kpis_json.conf
  ```
