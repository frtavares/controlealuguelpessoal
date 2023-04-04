@extends('master')

@section('title', $product->name)

@section('content')
<div class="product_single shadow-lg">
    <div class="inside">
        <div class="container">
            <div class="row">
            <!--Figura & Galeria -->
                <div class="col-md-4 pleft0">
                    <div class="slick-slider">
                        <div>
                        <a href="{{ url('/uploads/'.$product->file_path.'/'.$product->image)
                            }}" data-fancybox="gallery">
                            <img src="{{ url('/uploads/'.$product->file_path.'/'.$product->image)
                            }}" class="img-fluid">
                        </a>    
                        </div>
                    
                    @if(count($product->getGallery) > 0)
                        @foreach($product->getGallery as $gallery)
                        <div>
                        <a href="{{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name)
                                }}" data-fancybox="gallery">
                            <img src="{{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name)
                                }}" class="img-fluid"> 
                        </a>        
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>


                <div class="col-md-8">
                <h3 class="title">{{ $product->name }}</h3>
                    <div class="category">
                        <ul>
                            <li><a href="{{url('/')}}"><i class="fas fa-house-user"></i> Início</a></li>
                            <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>

                            <li><a href="{{url('/store')}}"><i class="fas fa-store"></i> Loja</a></li>
                            <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>

                            <li><a href="{{url('/store')}}"><i class="fas fa-folder"></i>{{ $product->cat->name }}</a></li>
                        @if(!is_null($product->subcategory_id))
                            <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>

                            <li><a href="{{url('/store')}}"><i class="fas fa-folder"></i>{{ $product->getSubcategory->name }}</a></li>
                        @endif
                        </ul>
                    </div>

                    <div class="add_cart mtop16">
                        {!! Form::open(['url' => '/cart/add']) !!}
                        <div class="row">
                                <div class="col-md-12">
                                    <span class="price">{{ Config::get('madecms.currency').number_format($product->price, 2,',','.')}}</span>
                                </div>
                        </div>

                        <div class="before_quantity">
                            <h5 class="title">Quantidade</h5>
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="quantity">
                                    
                                        <a href="#" class="amount_action" data-action="minus">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        {{ Form::number('quantity', 1 , ['class' => 'form-control', 'min' => '1', 'id' => 'add_to_cart_quantity'])}}
                                    
                                        <a href="#" class="amount_action" data-action="plus">
                                        <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                    
                                </div>

                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-cart-plus"></i> Incluir no Carrinho</button>
                                </div> 

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="content">
                         {!! html_entity_decode($product->content) !!}       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection