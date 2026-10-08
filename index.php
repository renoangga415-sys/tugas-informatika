```php
<?php
$hasil = false;

if (isset($_POST['hitung'])) {
    $produk  = $_POST['produk'];
    $bahan   = (float) $_POST['bahan'];
    $tenaga  = (float) $_POST['tenaga'];
    $overhead = (float) $_POST['overhead'];
    $jumlah  = (int) $_POST['jumlah'];

    if ($jumlah > 0) {
        $total_hpp = $bahan + $tenaga + $overhead;
        $hpp_unit = $total_hpp / $jumlah;
        $hasil = true;
    }
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kalkulator HPP</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            padding: 30px 15px;
        }

        .container {
            width: 100%;
            max-width: 850px;
            margin: auto;
        }

        /* HEADER */
        .header {
            text-align: center;
            color: white;
            margin-bottom: 25px;
        }

        .header .icon {
            width: 65px;
            height: 65px;
            background: white;
            color: #2563eb;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 15px;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .header p {
            opacity: 0.9;
            font-size: 15px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.2);
        }

        .card-title {
            margin-bottom: 22px;
        }

        .card-title h2 {
            font-size: 22px;
            color: #222;
        }

        .card-title p {
            color: #777;
            margin-top: 5px;
            font-size: 14px;
        }

        /* FORM */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 7px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            font-size: 15px;
            transition: 0.2s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .input-icon {
            position: relative;
        }

        .input-icon span {
            position: absolute;
            left: 14px;
            top: 14px;
            color: #777;
            font-size: 14px;
        }

        .input-icon input {
            padding-left: 45px;
        }

        /* BUTTON */
        .btn {
            width: 100%;
            margin-top: 25px;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37,99,235,0.3);
        }

        /* HASIL */
        .hasil {
            margin-top: 25px;
            background: #f8fafc;
            border-radius: 18px;
            padding: 22px;
            border: 1px solid #e5e7eb;
        }

        .hasil-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .hasil-header h2 {
            font-size: 20px;
        }

        .badge {
            background: #dcfce7;
            color: #15803d;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .produk {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .produk small {
            color: #777;
        }

        .produk strong {
            display: block;
            margin-top: 4px;
            font-size: 18px;
        }

        .detail {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .detail-box {
            background: white;
            padding: 15px;
            border-radius: 12px;
        }

        .detail-box small {
            color: #777;
            display: block;
            margin-bottom: 6px;
        }

        .detail-box strong {
            font-size: 15px;
        }

        .hasil-utama {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .total-box {
            padding: 20px;
            border-radius: 15px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
        }

        .total-box.unit {
            background: #f5f3ff;
            border-color: #ddd6fe;
        }

        .total-box small {
            color: #666;
            display: block;
            margin-bottom: 7px;
        }

        .total-box strong {
            font-size: 22px;
            color: #1d4ed8;
        }

        .total-box.unit strong {
            color: #6d28d9;
        }

        /* RUMUS */
        .rumus {
            margin-top: 20px;
            padding: 15px;
            border-radius: 12px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
        }

        .rumus h3 {
            font-size: 14px;
            margin-bottom: 7px;
        }

        .rumus p {
            color: #666;
            font-size: 13px;
            line-height: 1.7;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 13px;
            opacity: 0.85;
        }

        /* RESPONSIVE HP */
        @media (max-width: 650px) {

            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 25px;
            }

            .card {
                padding: 20px;
                border-radius: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .input-group.full {
                grid-column: auto;
            }

            .detail {
                grid-template-columns: 1fr;
            }

            .hasil-utama {
                grid-template-columns: 1fr;
            }

            .total-box strong {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="icon">
            💰
        </div>

        <h1>Kalkulator HPP</h1>

        <p>Hitung Harga Pokok Penjualan produk dengan mudah</p>

    </div>


    <!-- CARD UTAMA -->
    <div class="card">

        <div class="card-title">
            <h2>Input Data Produk</h2>
            <p>Masukkan biaya produksi untuk menghitung HPP.</p>
        </div>


        <form method="POST">

            <div class="form-grid">

                <!-- NAMA PRODUK -->
                <div class="input-group full">

                    <label>Nama Produk</label>

                    <input
                        type="text"
                        name="produk"
                        placeholder="Contoh: Keripik Pisang"
                        value="<?= isset($_POST['produk']) ? htmlspecialchars($_POST['produk']) : '' ?>"
                        required
                    >

                </div>


                <!-- BAHAN -->
                <div class="input-group">

                    <label>Biaya Bahan Baku</label>

                    <div class="input-icon">

                        <span>Rp</span>

                        <input
                            type="number"
                            name="bahan"
                            placeholder="100000"
                            min="0"
                            value="<?= $_POST['bahan'] ?? '' ?>"
                            required
                        >

                    </div>

                </div>


                <!-- TENAGA -->
                <div class="input-group">

                    <label>Biaya Tenaga Kerja</label>

                    <div class="input-icon">

                        <span>Rp</span>

                        <input
                            type="number"
                            name="tenaga"
                            placeholder="50000"
                            min="0"
                            value="<?= $_POST['tenaga'] ?? '' ?>"
                            required
                        >

                    </div>

                </div>


                <!-- OVERHEAD -->
                <div class="input-group">

                    <label>Biaya Overhead</label>

                    <div class="input-icon">

                        <span>Rp</span>

                        <input
                            type="number"
                            name="overhead"
                            placeholder="30000"
                            min="0"
                            value="<?= $_POST['overhead'] ?? '' ?>"
                            required
                        >

                    </div>

                </div>


                <!-- JUMLAH -->
                <div class="input-group">

                    <label>Jumlah Produk</label>

                    <input
                        type="number"
                        name="jumlah"
                        placeholder="20"
                        min="1"
                        value="<?= $_POST['jumlah'] ?? '' ?>"
                        required
                    >

                </div>

            </div>


            <button type="submit" name="hitung" class="btn">
                🔢 Hitung HPP
            </button>

        </form>


        <?php if ($hasil): ?>

        <!-- HASIL -->
        <div class="hasil">

            <div class="hasil-header">

                <h2>📊 Hasil Perhitungan</h2>

                <div class="badge">
                    BERHASIL
                </div>

            </div>


            <div class="produk">

                <small>Nama Produk</small>

                <strong>
                    <?= htmlspecialchars($produk) ?>
                </strong>

            </div>


            <div class="detail">

                <div class="detail-box">

                    <small>Bahan Baku</small>

                    <strong>
                        <?= rupiah($bahan) ?>
                    </strong>

                </div>


                <div class="detail-box">

                    <small>Tenaga Kerja</small>

                    <strong>
                        <?= rupiah($tenaga) ?>
                    </strong>

                </div>


                <div class="detail-box">

                    <small>Overhead</small>

                    <strong>
                        <?= rupiah($overhead) ?>
                    </strong>

                </div>

            </div>


            <div class="hasil-utama">

                <div class="total-box">

                    <small>Total HPP</small>

                    <strong>
                        <?= rupiah($total_hpp) ?>
                    </strong>

                </div>


                <div class="total-box unit">

                    <small>HPP per Unit</small>

                    <strong>
                        <?= rupiah($hpp_unit) ?>
                    </strong>

                </div>

            </div>


            <div class="rumus">

                <h3>📌 Rumus Perhitungan</h3>

                <p>
                    Total HPP = Bahan Baku + Tenaga Kerja + Overhead
                    <br>
                    HPP per Unit = Total HPP ÷ Jumlah Produk
                </p>

            </div>

        </div>

        <?php endif; ?>

    </div>


    <div class="footer">
        © Reno angga Dwi Syahputra 
    </div>

</div>

</body>
</html>
```
