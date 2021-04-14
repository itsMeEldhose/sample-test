<?php
class Test_model extends CI_model
{

    public function save($name,$quantity,$price,$total,$tax,$with_tax,$without_tax)
    {
        // $name = $this->input->post('name');
        // $quantity = $this->input->post('quantity');
        // $price = $this->input->post('price');
        // $total = $this->input->post('total');
        // $tax = $this->input->post('tax');
        // $with_tax = $this->input->post('with_tax');
        // $without_tax = $this->input->post('without_tax');

        if ($this->input->post('name', true)) {
            $length = sizeof($name);
            for ($i = 0; $i < $length; $i++) {
                $data = array(
                    'name' => $name[$i],
                    'price' => $price[$i],
                    'quantity' => $quantity[$i],
                    'total' => $total[$i],
                    'tax' => $tax[$i],
                    'with_tax' => $with_tax[$i],
                    'without_tax' => $without_tax[$i]

                );

                $this->db->insert('accounts', $data);
            }
        }
    }

    
}
