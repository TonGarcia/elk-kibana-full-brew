<?

$data = array(
              'capacidade' => array(
                'leitosOcupados' => 2243,
                'leitosOciosos' => 21,
                'equipamentos' => array(
                  'total' => 102,
                  'usadosEsteMes' => 15
                )
              ),
              'qtdProfissionais' => 345,
              'qtdExanes' => 1231,
              'orcamento' => array(
                'dotacao' => 153320193,
                'empenhado' => 1073241351,
                'liquidado' => 643944810,
                'pago' => 579550
              ));

header('Content-type: text/javascript');
echo json_encode($data);
