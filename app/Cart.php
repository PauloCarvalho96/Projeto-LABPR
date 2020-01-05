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

        if($this->items){
            //verifica se o item ja existe no carrinho
            if(array_key_exists($id,$this->items)){
                //se existir entao guarda o mesmo item (substitui o que foi inicialmente criado)
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['preco'] = $item->preco * $storedItem['qty']; // preço = preço unit * quantidade
        $this->items[$id] = $storedItem;
        //incrementa a quantidade
        $this->total_quantity++;
        //incrementa o preço
        $this->total_preco += $item->preco;
    }
}
