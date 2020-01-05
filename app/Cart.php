<?php

namespace App;

class Cart
{
    public $items = null;
    public $total_quantity = 0;
    public $total_preco = 0;

    public function __construct($oldCart)
    {
        //recupera dados do carrinho antigo se existir
        if($oldCart){
            $this->items = $oldCart->items;
            $this->total_quantity = $oldCart->total_quantity;
            $this->total_preco = $oldCart->total_preco;
        }
    }

    public function add($item, $id){
        $storedItem = ['qty' => 0, 'preco' => $item->preco, 'item' => $item];

        //verifica se existe produtos no carrinho
        if($this->items){
            //verifica se o item ja existe no carrinho
            if(array_key_exists($id,$this->items)){
                //se existir entao guarda o mesmo item (recupera os dados desse item)
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['preco'] = $item->preco * $storedItem['qty']; // preço = preço unit * quantidade
        $this->items[$id] = $storedItem;
        //incrementa a quantidade
        $this->total_quantity++;
        $this->total_preco += $item->preco;
    }
}
