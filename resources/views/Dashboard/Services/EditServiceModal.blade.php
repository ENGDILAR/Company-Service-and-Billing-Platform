<div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">تعديل الخدمة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="{{ route('Services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name{{ $service->id }}">اسم الخدمة</label>
                <input type="text" class="form-control" id="name{{ $service->id }}" name="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group">
                <label for="description{{ $service->id }}">الوصف</label>
                <textarea class="form-control" id="description{{ $service->id }}" name="description" rows="3">{{ $service->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price{{ $service->id }}">السعر</label>
                <input type="number" step="0.01" class="form-control" id="price{{ $service->id }}" name="price" value="{{ $service->price }}">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-success-gradient">تحديث الخدمة</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
