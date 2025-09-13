<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addServiceModalLabel">إضافة خدمة جديدة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="{{ route('Services.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">اسم الخدمة</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسم الخدمة" required>
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="أدخل وصف الخدمة"></textarea>
            </div>

            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="أدخل السعر">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary-gradient">حفظ الخدمة</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
