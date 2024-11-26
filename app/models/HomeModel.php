<?php

class HomeModel extends Model
{
    public function getResumoFinanceiro()
    {
        $resumo = [];
        $resumo['clientes'] = $this->db->query("SELECT COUNT(*) AS total FROM clientes")->fetch(PDO::FETCH_ASSOC)['total'];
        $resumo['contas_a_pagar'] = $this->db->query("SELECT SUM(valor) AS total FROM contas WHERE tipo = 'pagar'")->fetch(PDO::FETCH_ASSOC)['total'];
        $resumo['contas_a_receber'] = $this->db->query("SELECT SUM(valor) AS total FROM contas WHERE tipo = 'receber'")->fetch(PDO::FETCH_ASSOC)['total'];
        return $resumo;
    }
}
