
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
    
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">إضافة منتج جديد</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
  
      <div class="modal-body">
        <form action="{{route('Product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
       
            <div class="form-group">
                <label for="name">اسم المنتج</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسم المنتج" required>
            </div>
            
          
            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="أدخل السعر" >
            </div>
            
       
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="أدخل وصف المنتج" ></textarea>
            </div>
            
     
            <div class="form-group">
                <label for="image">صورة المنتج</label>
                <input type="file" class="form-control-file" id="image" name="ImagePath" accept="image/*" >
            </div>
            
         
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary-gradient">حفظ المنتج</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
