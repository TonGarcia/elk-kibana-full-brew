# ELK Kibana-full BREW
ELK Kibana Full brew usage

## Possible ERRORs
1. IF index not showing in visualization use FLOAT instead DOUBLE
1. Formatting numbers and fields:
  1. [Format Currency](https://discuss.elastic.co/t/adding-dollar-sign-in-metrics-visualization/95547)
  1. Format numbers and locale in general (Kibana > Management > Advanced Settings)
1. BigNumber Format:
  1. [Kibana > Management > index patterns > edit var > format number using 'a'](http://dashboard:5601/app/kibana#/management/kibana/index_patterns)
    1. [Numeraljs refer](http://numeraljs.com/)
    1. Sample: R$0.00 a
1. Sample of Scriptted Result (JSON input):
  ```
    {
      "script": "doc['Vl Categoria Vl Custo'].value / 2"
    }

    {
      "script": {
        "inline": "doc['Vl Categoria Vl Custo'].value / 3"
      }
    }
  ```

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
1. logstash.yml config file (uncomment comments), edit: /usr/local/Cellar/logstash-full/7.4.0/libexec/config/logstash.yml  

## Config kibana

1. Edit kibana settings
  ```shell script
      $ /usr/local/etc/kibana/kibana.yml
  ```
