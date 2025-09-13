<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عرض السجل - {{ $table->name }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body { 
            font-family: "Tahoma", sans-serif; 
            direction: rtl; 
            text-align: right; 
            margin: 0; 
            padding: 0; 
        }
        .container {
            padding: 15px;
            max-width: 95%;
            margin: auto;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            color: #333;
        }
        .header img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
        }
        .table-responsive {
            overflow-x: auto; 
        }
        table {
            border-collapse: collapse; 
            width: 100%; 
            margin: 10px 0; 
            font-size: 14px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: center;
            white-space: nowrap;
        }
        th { 
            background: #32393f; 
            color: #fff; 
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            margin: 10px 5px 0 0;
            background: #06090b;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <a href="{{ route('dashboard') }}" class="btn">🏠 الصفحة الرئيسية</a>
<div class="container">
    <div id="pdfContent">
        <div class="header">
            <h2>كشف حساب : {{ $table->name }}</h2>
            <img alt="user-img" class="avatar avatar-xl brround" src="{{ URL::asset('assets/img/brand/AlmamoBrand.jpg') }}">
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>البيان</th>
                        <th>له</th>
                        <th>عليه</th>
                        <th>الصافي</th>
                        <th>التاريخ</th>
                        <th>التفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($table->rows as $row)
                    <tr>
                        <td>{{ $row->statement }}</td>
                        <td>{{ $row->credit > 0 ?  $row->credit : "----"}}</td>
                        <td>{{ $row->debit > 0 ? $row->debit : "----" }}</td>
                        <td>{{ $row->credit - $row->debit }}</td>
                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                        <td>{{ $row->details }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#888;">لا توجد بيانات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h4>الصافي: {{ $table->total }}</h4>
    <br>

    <button class="btn" onclick="downloadPDF()">📄 تحميل PDF</button>
    <button class="btn" onclick="sharePDF()">📤 مشاركة</button>
</div>

<script>
    async function generatePDFBlob() {
        const { jsPDF } = window.jspdf;
        const content = document.getElementById("pdfContent");

        const canvas = await html2canvas(content, { scale: 2 });
        const imgData = canvas.toDataURL("image/png");

        const pdf = new jsPDF("p", "mm", "a4");
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

        pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);

        return pdf.output("blob");
    }

    async function downloadPDF() {
        const blob = await generatePDFBlob();
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "حساب-{{ $table->name }}.pdf";
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
    }

    async function sharePDF() {
        if (!navigator.canShare || !navigator.canShare({ files: [] })) {
            alert("المشاركة غير مدعومة على هذا الجهاز.");
            return;
        }

        const blob = await generatePDFBlob();
        const file = new File([blob], "حساب-{{ $table->name }}.pdf", { type: "application/pdf" });

        try {
            await navigator.share({
                title: "مشاركة كشف الحساب",
                text: "ملف PDF من النظام",
                files: [file]
            });
        } catch (err) {
            console.error("فشل المشاركة:", err);
        }
    }
</script>

</body>
</html>
