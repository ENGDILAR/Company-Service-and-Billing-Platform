<!-- resources/views/Dashboard/Products/EditProductModal.blade.php -->

<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">تعديل المنتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name{{ $product->id }}">اسم المنتج</label>
                        <input type="text" class="form-control" id="name{{ $product->id }}" name="name" value="{{ $product->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price{{ $product->id }}">السعر</label>
                        <input type="number" step="0.01" class="form-control" id="price{{ $product->id }}" name="price" value="{{ $product->price }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description{{ $product->id }}">الوصف</label>
                        <textarea class="form-control" id="description{{ $product->id }}" name="description" rows="3" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image{{ $product->id }}">صورة المنتج</label>
                        <input type="file" class="form-control-file" id="image{{ $product->id }}" name="ImagePath" accept="image/*">
                        @if($product->ImagePath)
                            <small class="form-text text-muted">الصورة الحالية: {{ $product->ImagePath }}</small>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary-gradient">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
