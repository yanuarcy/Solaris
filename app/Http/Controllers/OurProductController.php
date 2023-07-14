<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OurProductController extends Controller
{
    public function index(){
        $Tittle = 'SolarisTech - Product';

        $products = Product::all();
        $Kategoris = Kategori::all();

        foreach ($products as $produk) {
            $produk->hg_produk = 'Rp. ' . number_format($produk->hg_produk, 0, ',', '.');
        }

        return view('Produk.index', compact('Tittle', 'products', 'Kategoris'));
    }

    public function getKategori($kategori){
        if ($kategori === 'All') {
            $Tittle = 'SolarisTech - Product';

            $products = Product::all();
            $Kategoris = Kategori::all();

            return view('Produk.index', compact('products', 'Kategoris', 'Tittle'));

        } else {
            $Tittle = 'SolarisTech - Product';

            $Kategoris = Kategori::all();
            $products = Product::where('kategori_id', $kategori)->get();
        }


        return view('Produk.index', compact('Tittle', 'products', 'Kategoris'));
    }

    public function addToCart($id) {
        $product = Product::find($id);
        // $cart = session()->get('cart_' . $userId, []);

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartKey = 'cart_' . $userId;
            $cart = Cache::get($cartKey, []);
        } else {
            // $cart = session()->get('cart', []);
            $cart = Cache::get('cart', []);
            // $cart = json_decode(request()->cookie('cart'), true) ?? [];
            // $cart = request()->cookie('cart') ?i json_decode(request()->cookie('cart'), true) : [];
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nm_produk" => $product->nm_produk,
                "photo" => $product->photo,
                "hg_produk" => $product->hg_produk,
                "quantity" => 1
            ];
        }

        if (auth()->check()) {
            Cache::put($cartKey, $cart);
        } else {
            // session()->put('cart', $cart);
            Cache::put('cart', $cart);
            // $cookie = cookie('cart', null, -1); // Set cookie for 7 days
            // dd($cart);
            // return redirect()->route('GetProduk')->cookie($cookie);

            // // Split the cart data into multiple cookies if it exceeds the maximum size
            // $cartChunks = array_chunk($cart, 10); // Split into chunks of 10 products
            // foreach ($cartChunks as $index => $chunk) {
            //     $cookieName = 'cart_' . $index;
            //     $cookieValue = json_encode($chunk);
            //     $cookie = cookie($cookieName, $cookieValue, 60*24*7); // Set cookie for 7 days
            //     dd($cart);
            //     return redirect()->route('GetProduk')->cookie($cookie);
            // }
        }
        // session()->put('cart'. $userId,  $cart);

        // dd($cart);

        return redirect()->route('GetProduk');
    }


    // public function addToCart(Request $request, $productId)
    // {
    //     // Mengambil produk berdasarkan ID
    //     $product = Product::find($productId);

    //     if (!$product) {
    //         // Produk tidak ditemukan, mungkin perlu menangani kasus ini
    //         return redirect()->back()->withErrors('Produk tidak ditemukan.');
    //     }

    //     // Tambahkan produk ke keranjang belanja (sesuai dengan struktur data yang digunakan)
    //     $cart = $request->session()->get('cart', []);

    //     // Cek apakah produk sudah ada di dalam keranjang
    //     $existingProduct = collect($cart)->firstWhere('id', $product->id);

    //     if ($existingProduct) {
    //         // Jika produk sudah ada di keranjang, tambahkan jumlahnya
    //         $existingProduct['quantity'] += 1;
    //     } else {
    //         // Jika produk belum ada di keranjang, tambahkan produk baru ke dalam keranjang
    //         $newProduct = [
    //             'id' => $product->id,
    //             'name' => $product->nm_produk,
    //             'price' => $product->hg_produk,
    //             'quantity' => 1,
    //         ];
    //         $cart[] = $newProduct;
    //     }

    //     // Simpan kembali keranjang belanja ke dalam sesi
    //     $request->session()->put('cart', $cart);
    //     $request->session()->forget('cart');


    //     // Setelah menambahkan ke keranjang, Anda dapat mengarahkan pengguna ke halaman yang sesuai
    //     return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang belanja.');
    // }
}
