@extends('Template.template')

@section('Content')

    <div class="container">
        <div class="card">
            <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" >
                        @foreach ($Kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nm_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nama_produk">Stok</label>
                    <input type="text" name="stok" id="stok">
                </div>
                <div>
                    <label for="nama_produk">Harga Produk</label>
                    <input type="text" name="harga_produk" id="harga_produk" value="Rp ">
                </div>
                <div>
                    <label for="nama_produk">Deskripsi Produk</label>
                    <input type="text" name="desc_produk" id="desc_produk">
                </div>

                <div>
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar">
                </div>

                <a href="{{ route('Product.index') }}">Back</a>
                <button type="submit">Tambah Produk</button>

            </form>
        </div>
    </div>

@endsection
