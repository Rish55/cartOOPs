<?php
namespace App;
class cart{
    private array $cart;
    /**
     * cart constructor
     */
    public function __construct()
    {  
        $this->cart =array();          
    }
    
    /**
     * addToProduct
     *
     * @param products $product
     * @return void
     */
    public function addToCart(products $product){
        if($this->isProductExist($product)){
            array_push($this->cart,$product);
        } 
    }

    /**
     * check if Product is already added in cart
     */
    private function isProductExist(products $product){
        foreach($this->cart as $key => $p){
            if($p->id == $product->id){
                $this->cart[$key]->quantity +=1;
                return false;
            }
        }

        return true;
    }
    
    /**
     * remove Product from cart
     */

    public function removeProductFromCart(int $id){
        foreach($this->cart as $key => $p){
            if($p->id == $id){
              array_splice($this->cart,$key,1);
              break;
            }
        }
    }
   
    /**
     * edit quantity of product if already added in cart
     */

    public function editQuantity($id,$qnty){
        foreach($this->cart as $key => $p){
            if($p->id == $id){
              $this->cart[$key]->quantity = $qnty;
              break;
            }
        }
    }
    
    /**
     * set seesion value to cart
     */

    public function setCart(array $cartData){

        $this->cart = $cartData;
    }
    /**
     * return cart array
     *
     * @return void
     */
    public function getCart(){
        return $this->cart;
    }

   


}
