<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div id="pos-app" class="h-full w-full relative">
            <!-- <div id="loader" class="top-0 anim-duration-500 fade-in-entrance left-0 absolute w-full z-50 h-full flex flex-col items-center justify-center">
                <p class="font-semibold py-2">{{ __( 'Loading...' ) }}</p>
            </div> -->
            <div class="h-full flex-auto flex flex-col" id="pos-container">
                <div class="flex overflow-hidden flex-shrink-0 px-2 pt-2">
                    <div class="-mx-2 flex overflow-x-auto pb-1">
                        <div class="header-buttons flex px-2 flex-shrink-0" :key="index" v-for="(component,index) of buttons">
                            <div class="px-2 flex flex-row gap-2 overflow-x-auto">
                                <a href="{{route('dashboard')}}" class="bg-green-500 inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    {{ __('Dashboard') }}
                                </a>
                                <button id="usermodal" class="bg-gray-100 inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-sm text-gray-900 hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ __('Clients') }}
                                </button>
                                <a href="" class="bg-gray-100 inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold text-sm text-gray-900 hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                    </svg>
                                    {{ __('Réinitialiser') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto overflow-hidden flex p-2">
                    <div class="flex flex-auto overflow-hidden -m-2">
                        <div class="flex w-1/2 overflow-hidden p-2">
                            <div class="rounded shadow ns-tab-item flex-auto flex overflow-hidden">
                                <div class="cart-table flex flex-auto flex-col overflow-hidden">
                                    <div id="cart-products-table" class="flex flex-auto flex-col overflow-auto">
                                        
                                        <!-- Loop Procuts On Cart -->

                                        <div class="text-primary flex" v-if="products.length === 0">
                                            <div class="w-full text-center py-4 border-b">
                                                <h3>{{ __( 'No products added...' ) }}</h3>
                                            </div>
                                        </div>

                                        <div :product-index="index" :key="product.barcode" class="product-item flex" v-for="(product, index) of products">
                                            <div class="w-full lg:w-4/6 p-2 border border-l-0 border-t-0">
                                                <div class="flex justify-between product-details mb-1">
                                                    <h3 class="font-semibold">
                                                        name
                                                    </h3>
                                                    <div class="-mx-1 flex product-options">
                                                        <div class="px-1"> 
                                                            <a @click="remove( product )" class="hover:text-error-secondary cursor-pointer outline-none border-dashed py-1 border-b border-error-secondary text-sm">
                                                                <i class="las la-trash text-xl"></i>
                                                            </a>
                                                        </div>
                                                        <div class="px-1" v-if="options.ns_pos_allow_wholesale_price && allowQuantityModification( product )"> 
                                                            <a :class="product.mode === 'wholesale' ? 'text-success-secondary border-success-secondary' : 'border-info-primary'" @click="toggleMode( product )" class="cursor-pointer outline-none border-dashed py-1 border-b  text-sm">
                                                                <i class="las la-award text-xl"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between product-controls">
                                                    <div class="-mx-1 flex flex-wrap">
                                                        <div class="px-1 w-1/2 md:w-auto mb-1">
                                                            <a
                                                                @click="changeProductPrice( product )"
                                                                :class="product.mode === 'wholesale' ? 'text-success-secondary hover:text-success-secondary border-success-secondary' : 'border-info-primary'"
                                                                class="cursor-pointer outline-none border-dashed py-1 border-b  text-sm"
                                                            >{{ __( 'Price' ) }} : unit_price</a>
                                                        </div>
                                                        <div class="px-1 w-1/2 md:w-auto mb-1"> 
                                                            <a v-if="allowQuantityModification( product )" @click="openDiscountPopup( product, 'product' )" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Discount' ) }} <span v-if="product.discount_type === 'percentage'">%</span> : fcfa</a>
                                                        </div>
                                                        <div class="px-1 w-1/2 md:w-auto mb-1 lg:hidden"> 
                                                            <a v-if="allowQuantityModification( product )" @click="changeQuantity( product )" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Quantity' ) }}: quantity</a>
                                                        </div>
                                                        <div class="px-1 w-1/2 md:w-auto mb-1 lg:hidden"> 
                                                            <span class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Total' ) }}: total_price</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div @click="changeQuantity( product )" :class="allowQuantityModification( product ) ? 'cursor-pointer ns-numpad-key' : ''" class="hidden lg:flex w-1/6 p-2 border-b items-center justify-center">
                                                <span v-if="allowQuantityModification( product )" class="border-b border-dashed border-info-primary p-2">quantity</span>
                                            </div>
                                            <div class="hidden lg:flex w-1/6 p-2 border border-r-0 border-t-0 items-center justify-center">total_price</div>
                                        </div>
                                        
                                        <!-- End Loop -->

                                    </div>
                                    <div id="cart-products-summary" class="flex">
                                        <table class="table ns-table w-full text-sm ">
                                            <tr>
                                                <td width="200" class="border p-2">
                                                    <a @click="selectCustomer()" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Customer' ) }}: </a>
                                                </td>
                                                <td width="200" class="border p-2">{{ __( 'Sub Total' ) }}</td>
                                                <td width="200" class="border p-2 text-right">subtotal</td>
                                            </tr>
                                            <tr>
                                                <td width="200" class="border p-2">
                                                    <a @click="openOrderType()" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Type' ) }}: </a>
                                                </td>
                                                <td width="200" class="border p-2">
                                                    <span>{{ __( 'Discount' ) }}</span>
                                                    <span v-if="order.discount_type === 'percentage'">%</span>
                                                </td>
                                                <td width="200" class="border p-2 text-right">
                                                    <a @click="openDiscountPopup( order, 'cart' )" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">discount</a>
                                                </td>
                                            </tr>
                                            <tr v-if="order.type && order.type.identifier === 'delivery'">
                                                <td width="200" class="border p-2"></td>
                                                <td width="200" class="border p-2">
                                                    <a @click="openShippingPopup()" class="cursor-pointer outline-none border-dashed py-1 border-b border-info-primary text-sm">{{ __( 'Shipping' ) }}</a>
                                                </td>
                                                <td width="200" class="border p-2 text-right">shipping</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="h-16 flex flex-shrink-0 border-t border-box-edge" id="cart-bottom-buttons">
                                        <div @click="payOrder()" id="pay-button" class="flex-shrink-0 w-1/4 flex items-center font-bold cursor-pointer justify-center bg-green-500 text-white hover:bg-green-600 border-r border-green-600 flex-auto">
                                            <i class="mr-2 text-2xl lg:text-xl las la-cash-register"></i> 
                                            <span class="text-lg hidden md:inline lg:text-2xl">{{ __( 'Pay' ) }}</span>
                                        </div>
                                        <div @click="holdOrder()" id="hold-button" class="flex-shrink-0 w-1/4 flex items-center font-bold cursor-pointer justify-center bg-blue-500 text-white border-r hover:bg-blue-600 border-blue-600 flex-auto">
                                            <i class="mr-2 text-2xl lg:text-xl las la-pause"></i> 
                                            <span class="text-lg hidden md:inline lg:text-2xl">{{ __( 'Hold' ) }}</span>
                                        </div>
                                        <div @click="openDiscountPopup( order, 'cart' )" id="discount-button" class="flex-shrink-0 w-1/4 flex items-center font-bold cursor-pointer justify-center bg-white border-r border-box-edge hover:bg-indigo-100 flex-auto text-gray-700">
                                            <i class="mr-2 text-2xl lg:text-xl las la-percent"></i> 
                                            <span class="text-lg hidden md:inline lg:text-2xl">{{ __( 'Discount' ) }}</span>
                                        </div>
                                        <div @click="voidOngoingOrder( order )" id="void-button" class="flex-shrink-0 w-1/4 flex items-center font-bold cursor-pointer justify-center bg-red-500 text-white border-box-edge hover:bg-red-600 flex-auto">
                                            <i class="mr-2 text-2xl lg:text-xl las la-trash"></i> 
                                            <span class="text-lg hidden md:inline lg:text-2xl">{{ __( 'Void' ) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-1/2 flex overflow-hidden">
                            <div id="grid-container" class="rounded shadow  overflow-hidden flex-auto flex flex-col">
                                <div id="grid-header" class="p-2 border-b ">
                                    <div class="border rounded flex  overflow-hidden">
                                        <button :title="__( 'Search for products.' )" @click="openSearchPopup()" class="w-10 h-10 border-r  outline-none">
                                            <i class="las la-search"></i>
                                        </button>
                                        <button :title="__( 'Toggle merging similar products.' )" @click="posToggleMerge()" :class="settings.ns_pos_items_merge ? 'pos-button-clicked' : ''" class="outline-none w-10 h-10 border-r ">
                                            <i class="las la-compress-arrows-alt"></i>
                                        </button>
                                        <button :title="__( 'Toggle auto focus.' )" @click="options.ns_pos_force_autofocus = ! options.ns_pos_force_autofocus" :class="options.ns_pos_force_autofocus ? 'pos-button-clicked' : ''" class="outline-none w-10 h-10 border-r ">
                                            <i class="las la-barcode"></i>
                                        </button>
                                        <input ref="search" v-model="barcode" type="text" class="flex-auto outline-none px-2 ">
                                    </div>
                                </div>
                                <div style="height: 0px">
                                    <div v-if="isLoading" class="fade-in-entrance ns-loader">
                                        <div class="bar"></div>
                                    </div>
                                </div>
                                <div id="grid-breadscrumb" class="p-2">
                                    <ul class="flex">
                                        <li><a @click="loadCategories()" href="javascript:void(0)" class="px-3 ">{{ __( 'Home' ) }} </a> <i class="las la-angle-right"></i> </li>
                                        <li><a @click="loadCategories( bread )" v-for="bread of breadcrumbs" :key="bread.id" href="javascript:void(0)" class="px-3">breadname <i class="las la-angle-right"></i></a></li>
                                    </ul>
                                </div>
                                <div id="grid-items" class="overflow-hidden h-full flex-col flex">
                                    <div v-if="! rebuildGridComplete" class="h-full w-full flex-col flex items-center justify-center">
                                        <ns-spinner></ns-spinner>
                                        <span class="my-2">{{ __( 'Rebuilding...' ) }}</span>
                                    </div>
                                    <template v-if="rebuildGridComplete">

                                        <VirtualCollection
                                            :cellSizeAndPositionGetter="cellSizeAndPositionGetter"
                                            :collection="categories"
                                            :height="gridItemsHeight"
                                            :width="gridItemsWidth"
                                            v-if="hasCategories"
                                        >
                                            <div slot="cell" class="w-full h-full" slot-scope="{ data }">
                                                <div @click="loadCategories( data )" :key="data.id" class="cell-item w-full h-full cursor-pointer border flex flex-col items-center justify-center overflow-hidden">
                                                    <div class="h-full w-full flex items-center justify-center">
                                                        <img v-if="data.preview_url" :src="data.preview_url" class="object-cover h-full" :alt="data.name">
                                                        <i class="las la-image text-6xl" v-if="! data.preview_url"></i>
                                                    </div>
                                                    <div class="h-0 w-full">
                                                        <div class="cell-item-label relative w-full flex items-center justify-center -top-10 h-20 py-2">
                                                            <h3 class="text-sm font-bold py-2 text-center">dataname</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </VirtualCollection>
                                        <VirtualCollection
                                            :cellSizeAndPositionGetter="cellSizeAndPositionGetter"
                                            :collection="products"
                                            :height="gridItemsHeight"
                                            :width="gridItemsWidth"
                                            v-if="! hasCategories">
                                            <div slot="cell" class="w-full h-full" slot-scope="{ data }">
                                                <div @click="addToTheCart( data )" :key="data.id" class="cell-item w-full h-full cursor-pointer border flex flex-col items-center justify-center overflow-hidden">
                                                    <div class="h-full w-full flex items-center justify-center overflow-hidden">
                                                        <img v-if="data.galleries && data.galleries.filter( i => i.featured === 1 ).length > 0" :src="data.galleries.filter( i => i.featured === 1 )[0].url" class="object-cover h-full" :alt="data.name">
                                                        <i v-if="! data.galleries || data.galleries.filter( i => i.featured === 1 ).length === 0" class="las la-image text-6xl"></i>
                                                    </div>
                                                    <div class="h-0 w-full">
                                                        <div class="cell-item-label relative w-full flex flex-col items-center justify-center -top-10 h-20 p-2">
                                                            <h3 class="text-sm text-center w-full">dataname</h3>
                                                            <template v-if="options.ns_pos_price_with_tax === 'no'">
                                                                <span class="text-sm" v-if="data.unit_quantities && data.unit_quantities.length === 1">
                                                                    unit_quantities[0]
                                                                </span>
                                                            </template>
                                                            <template v-if="options.ns_pos_price_with_tax === 'yes'">
                                                                <span class="text-sm" v-if="data.unit_quantities && data.unit_quantities.length === 1">
                                                                    unit_quantities[0]
                                                                </span>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </VirtualCollection>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
