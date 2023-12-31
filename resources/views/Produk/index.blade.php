@extends('Template.template')

@vite('resources/sass/Produk/index.scss')
@vite('resources/sass/Produk/dropdown.scss')
@vite('resources/sass/Layouts/nav.scss')
@vite('resources/js/produk.js')

@section('Content')

    @include('Layouts.nav')

    <div class="container">
        <div class="row SelectBox">
            <form action="">
                {{-- <h1 class="text-white">{{ isset($hai) ? $hai : '' }}</h1> --}}
                {{-- <select name="kategori" id="kategori" class="form-select">
                    @foreach ($Kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nm_kategori }}</option>
                    @endforeach
                </select> --}}
                {{-- <div class="dropdown">
                    <select class="button">Category
                        <div class="content">
                            <option>Meu Perfil</option>
                            <option>Alterar Senha</option>
                            <option>Seir</option>
                        </div>
                    </select>
                </div> --}}
                <div class="select-menu">
                    <div class="select-btn">
                        <span class="sBtn-text" data-value="All">Select your option</span>
                    </div>

                    <ul class="options" id="option-list">
                        <li class="option">
                            <option data-value="All" class="option-text">All</option>
                        </li>
                        @foreach ($Kategoris as $kategori )
                            <li class="option">
                                <option class="option-text" data-value="{{ $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nm_kategori }}</option>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            @foreach ($products as $product )
                <div class="card">
                    @if ($product->photo)
                        <img src="{{ Vite::asset('resources/images/' . $product->photo) }}" class="card-img-top" alt="{{ $product->nm_produk }}">
                    @else
                        Gambar tidak tersedia
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nm_produk }}</h5>
                        <p class="card-text">{{ $product->hg_produk }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-warning"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('addTo-Cart', $product->id) }}" class="btn btn-primary"><i class="bi bi-cart3"></i></a>
                        {{-- <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-cart3"></i></button>
                        </form> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
