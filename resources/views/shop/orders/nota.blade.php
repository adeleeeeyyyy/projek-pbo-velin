<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan #{{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        body {
            font-family: 'Courier Prime', monospace;
            padding: 40px;
            background: #fff;
            color: #333;
            max-width: 800px;
            margin: auto;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #ff92b1;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #ff6692;
            margin: 0;
            font-size: 32px;
            font-weight: 900;
            font-style: italic;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info div {
            flex: 1;
        }
        .section-title {
            font-weight: 700;
            text-transform: uppercase;
            font-style: italic;
            border-bottom: 1px solid #ffeef2;
            margin-bottom: 10px;
            color: #ff6692;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            text-align: left;
            border-bottom: 2px solid #ff92b1;
            padding: 10px;
            color: #ff6692;
            font-style: italic;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ffeef2;
        }
        .total {
            text-align: right;
            font-size: 24px;
            font-weight: 900;
            font-style: italic;
            color: #ff6692;
            margin-top: 20px;
            border-top: 2px dashed #ff92b1;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #999;
            font-style: italic;
        }
        .stamp {
            border: 3px double #ff92b1;
            color: #ff92b1;
            display: inline-block;
            padding: 10px 20px;
            font-weight: 900;
            font-style: italic;
            transform: rotate(-10deg);
            margin-top: 20px;
            border-radius: 10px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="background: #ff6692; color: white; border: none; padding: 10px 20px; border-radius: 20px; font-weight: bold; cursor: pointer;">Cetak Sekarang</button>
    </div>

    <div class="header">
        <h1>Shangdian ATK</h1>
        <p>Solusi Lengkap Buku & Alat Tulis Kantor</p>
        <p>Nota Pembelian / Struk Belanja</p>
    </div>

    <div class="info">
        <div>
            <div class="section-title">Pesanan</div>
            <p>
                No: #{{ $order->order_number }}<br>
                Tgl: {{ $order->created_at->format('d/m/Y H:i') }}<br>
                Status: {{ $order->status }}
            </p>
        </div>
        <div>
            <div class="section-title">Penerima</div>
            <p>
                {{ $order->name }}<br>
                {{ $order->email }} / {{ $order->phone }}<br>
                {{ $order->address }} ({{ $order->postal_code }})
            </p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
    </div>

    <div style="text-align: right;">
        <div class="stamp">
            {{ strtoupper($order->status) }}
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Shangdian ATK!</p>
        <p>Nota ini adalah bukti transaksi yang sah.</p>
        <p>&copy; {{ date('Y') }} Shangdian ATK Premium</p>
    </div>
</body>
</html>
