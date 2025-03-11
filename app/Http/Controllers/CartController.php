<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $items = \Cart::getContent();
        $subTotal = \Cart::getSubTotal();
        $Total= \Cart::getTotal();
        return view('',compact('items','subTotal','total'));
    }

    public function add($produitID,$qte){
        $Produit = Produit::find($produitID);
        \Cart::add(array(
            'id' => $Produit->id,
            'name' => $Produit->designation,
            'price' => $Produit->prix_ht * (1+$Produit->tva/100),
            'quantity' => $qte,
            'attributes' => array(),
            'associatedModel' => $Produit
        ));
        return redirect()->back()->with('success','item has beed added to cart successfully');
    }

    public function update($produitID ,$qte){
        \Cart::update($produitID, array(
            'quantity' => $qte,
        ));
        return redirect()->back()->with('success','item has been updated successfully');
    }

    public function remove($produitID){
        \Cart::remove($produitID);
        return redirect()->back()->with('success','item has been removed successfully');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->back()->with('success','Cart has been cleared successfully');
    }

    public function checkout(){
        if(\Cart::isEmpty()){
            return redirect()->back->with('error','cart is empty');
        }
        # $ModeReglements = ModeReglements::all();
        # $addresse =
        $total = \Cart::getTotal();
        return view('',compact('$total'));
    }
}
