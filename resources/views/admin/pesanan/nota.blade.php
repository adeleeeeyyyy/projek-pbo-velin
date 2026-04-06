<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 20px; }
    .header { text-align: center; border-bottom: 2px solid #c4738c; padding-bottom: 12px; margin-bottom: 20px; }
    .header h1 { font-size: 20px; color: #c4738c; margin: 0; }
    .header p { margin: 4px 0; font-size: 11px; color: #666; }
    .info-grid { display: flex; gap: 20px; margin-bottom: 20px; }
    .info-box { flex: 1; background: #fdf2f8; border: 1px solid #fbcfe8; border-radius: 6px; padding: 10px; }
    .info-box h3 { font-size: 11px; color: #9d174d; margin: 0 0 8px 0; text-transform: uppercase; }
    .info-box p { margin: 2px 0; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    th { background: #fdf2f8; color: #9d174d; font-size: 11px; padding: 8px; text-align: left; border-bottom: 2px solid #fbcfe8; }
    td { padding: 8px; border-bottom: 1px solid #fce7f3; font-size: 11px; }
    .text-right { text-align: right; }
    .total-row td { font-weight: bold; background: #fdf2f8; font-size: 13px; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: bold; }
    .footer { text-align: center; font-size: 10px; color: #999; margin-top: 30px; border-top: 1px solid #fce7f3; padding-top: 12px; }
</style>
</head>
<body>
<div class="header">
    <h1>🛒 Shangdian ATK</h1>
    <p>Nota Pembelian</p>
</div>

<div class="info-grid">
    <div class="info-box">
        <h3>Info Pesanan</h3>
        <p><strong>No. Pesanan:</strong> {{ $pesanan->order_number }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y') }}</p>
        <p><strong>Status:</strong> {{ $pesanan->status }}</p>
    </div>
    <div class="info-box">
        <h3>Dikirim ke</h3>
        <p><strong>{{ $pesanan->name }}</strong></p>
        <p>{{ $pesanan->email }}</p>
        <p>{{ $pesanan->phone }}</p>
        <p>{{ $pesanan->address }}</p>
        <p>Kode Pos: {{ $pesanan->postal_code }}</p>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Produk</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Jumlah</th>
            <th class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesanan->detailPesanans as $i => $d)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $d->produk->nama ?? 'Produk dihapus' }}</td>
            <td class="text-right">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
            <td class="text-right">{{ $d->jumlah }}</td>
            <td class="text-right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="total-row">
            <td colspan="4" class="text-right">Total</td>
            <td class="text-right">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

<div class="footer">
    <p>Terima kasih telah berbelanja di Shangdian ATK!</p>
    <p>Nota ini dibuat secara otomatis dan tidak memerlukan tanda tangan.</p>
</div>
</body>
</html>
