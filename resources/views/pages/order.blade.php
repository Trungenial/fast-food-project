<style>


    .order-information{
        display: flex;
        gap: 40px;
    }

    .customer-information .order-information{
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

</style>  
@extends('layouts.main')

@section('title', 'Thanh toán')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <div class="order-container">
        <div class="order-header">
            <span>THÔNG TIN ĐƠN HÀNG</span> 
        </div>
        <div class="order-information">
            <form action="#" method="POST" class="order-form">
                @csrf
                <div class='customer-information'>
                    <h3>GIAO HÀNG ĐẾN</h3>
                    <div class="form-input">
                        <input type='text' name="first-name" id="first-name" placeholder="Họ *" required>
                        <input type='text' name="last-name" id ="last-name" placeholder="Tên *" required>
                    </div>
                    <div class="form-input">
                        <input type='text' name="phone" id="phone" placeholder="Số điện thoại *" required>
                        <input type='email' name="email" id="email" placeholder="Email *" required>
                    </div>
                    <div class="form-input">    
                        <textarea placeholder="Ghi chú" id="note" rows='4' cols="50"></textarea>
                    </div>
                    <h3>PHƯƠNG THỨC VẬN CHUYỂN</h3>
                        <hr>
                        <input type='radio' name="transportation" id = "home-address">Giao hàng tận nơi
                        <hr>
                        <input type='radio' name="transportation" id = "store">Hẹn lấy tại cửa hàng
                        <label>Tỉnh thành</label>
                        <select id="province" name="province" title="Tỉnh thành"
                            class="validate select block mt-1 w-full
                                    w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center 
                                    justify-between hover:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                    data-validate="required:true"
                                aria-required="true">
                                    <option value  disabled selected class="dark: text-gray-300">TP Hồ Chí Minh</option>
                                
                            
                            </select>
                            <label>Cửa hàng</label>
                            <select id="store" name="store" title="Cửa hàng"
                            class="validate select block mt-1 w-full
                                    w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-left flex items-center 
                                    justify-between hover:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                    data-validate="required:true"
                                aria-required="true">
                                    <option value disabled selected class="dark: text-gray-300">Chọn cửa hàng *</option>
                                   
                            </select>
                    <h3>GHI CHÚ ĐƠN HÀNG</h3>
                    <div class="form-input">    
                        <textarea placeholder="Ghi chú thêm..." id="order-note" rows='4' cols="50"></textarea>
                    </div>
                    <a href="{{'menu'}}">
                        <button type="button" class="btn-back">
                        TRỞ LẠI
                        </button>
                    </a>    
                    <button type="submit" class="btn-payment"> THANH TOÁN
                    </button>
                </div>
                <div class='product-information'>
                    
                </div>
            </form>
        </div>
    </div>
@endsection
