<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid pt-5 mb-3">
  <div class="container">
    <div class="section-title">
      <h4 class="m-0 text-uppercase font-weight-bold"><?= $title ?></h4>
    </div>
    <?php if (session()->get('success')) : ?>
      <div class="alert alert-success">
        <?= session()->get('success') ?>
      </div>
    <?php endif; ?>
    <div class="row justify-content-center">
      <div class="col-md-12 mb-18">
        <div class="position-relative overflow-hidden">
          <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3 border-0">
              <h4 class="app-card-title text-center">Total Pengiriman Email</h4>
            </div>
            <div class="app-card-body p-4">
              <div class="chart-container">
                <canvas id="chart" style="display: block; box-sizing: border-box; width: 100%;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 mb-8">
        <div class="position-relative overflow-hidden">
          <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3 border-0">
              <h4 class="app-card-title text-center">Negara Tujuan</h4>
            </div>
            <div class="app-card-body p-4">
              <div class="chart-container">
                <canvas id="pie-chart" class="pie-chart-canvas" style="display: block; box-sizing: border-box; width: 100%;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <hr class="mb-4">
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-IMCPPZxtLvdt9tam8RJ8ABMzn+Mq3SQiInbDmMYwjDg=" crossorigin="anonymous"></script>
<script>
  const members = <?php echo json_encode(array_column($memberEmails, 'nama_user')); ?>;
  const emails = <?php echo json_encode(array_column($memberEmails, 'kirim_emails_count')); ?>;
  const ctx = document.getElementById("chart").getContext('2d');
  const dataExists = members.length > 0 && emails.length > 0;

  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: members,
      datasets: [{
        label: 'Jumlah Kirim Email',
        backgroundColor: 'rgba(92, 179, 119, 0.7)',
        borderColor: 'rgba(21, 163, 98, 1)',
        borderWidth: 1,
        data: emails,
      }]
    },
    options: {
      responsive: true,
      scales: {
        xAxes: [{
          type: 'category', // Tipe sesuaikan dengan data Anda
          position: 'bottom', // Atau 'top' jika sesuai
          gridLines: {
            display: false,
          },
          ticks: {
            fontColor: 'black',
            fontSize: 12,
          }
        }],
        yAxes: [{
          type: 'linear', // Tipe sesuaikan dengan data Anda
          position: 'left', // Atau 'right' jika sesuai
          gridLines: {
            color: 'rgba(0, 0, 0, 0.1)',
          },
          ticks: {
            fontColor: 'black',
            fontSize: 12,
            beginAtZero: true,
            stepSize: 1,
          }
        }]
      },
    }
  });

  const negara = <?php echo json_encode(array_column($kirimEmails, 'negara_perusahaan')); ?>;
  const total = <?php echo json_encode(array_column($kirimEmails, 'total_negara')); ?>;

  // ... (Tetapkan kode pie chart seperti yang diberikan sebelumnya)
  function darkenColor(color, amount) {
    let r = parseInt(color.slice(1, 3), 16);
    let g = parseInt(color.slice(3, 5), 16);
    let b = parseInt(color.slice(5, 7), 16);

    // "Mendarken" warna dengan menggeser nilai RGB ke arah minimum (0) menggunakan amount
    r = Math.round(r * (1 - amount));
    g = Math.round(g * (1 - amount));
    b = Math.round(b * (1 - amount));

    const newColor = `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
    return newColor;
  }

  function getRandomColor() {
    const minBrightness = 150; // Atur nilai minimal kecerahan warna (0-255)

    let r, g, b;
    do {
      r = Math.floor(Math.random() * 256);
      g = Math.floor(Math.random() * 256);
      b = Math.floor(Math.random() * 256);
    } while ((r + g + b) / 3 < minBrightness); // Periksa rata-rata kecerahan warna

    const randomColor = `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
    return randomColor;
  }

  // Generate random colors for each country
  const colors = [];
  const borderColors = [];
  for (let i = 0; i < negara.length; i++) {
    const randomColor = getRandomColor();
    colors.push(randomColor);

    // Lighten the color by 30% to get the borderColor
    const borderColor = darkenColor(randomColor, 0.3);
    borderColors.push(borderColor);
  }

  const totalAngka = total.map(val => parseInt(val, 10));
  const totalSum = totalAngka.reduce((acc, val) => acc + val, 0);

  const ctx2 = document.getElementById("pie-chart").getContext('2d');

  // Hitung persentase untuk setiap data
  const persentaseData = total.map(value => ((value / totalSum) * 100).toFixed(1));
  // Buat array label baru yang menggabungkan label negara dengan persentase
  const labeledData = negara.map((label, index) => `${label}\n(${persentaseData[index]}%)`);

  const myPieChart = new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: labeledData, // Gunakan array label yang baru dibuat
      datasets: [{
        label: 'Jumlah Kirim Email',
        backgroundColor: colors,
        borderColor: "transparent",
        data: total,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      aspectRatio: 2.5,
      scales: {
        xAxes: [{
          barPercentage: 0.75, // Atur lebar bar sesuai kebutuhan
          categoryPercentage: 1.0, // Atur jarak antar bar sesuai kebutuhan
          ticks: {
            autoSkip: false,
            beginAtZero: true,
            fontColor: 'black',
            fontSize: 13,
          },
          offset: true, // Aktifkan opsi offset agar data lebih leluasa dalam penempatan
          maxBarThickness: 200, // Atur ketebalan maksimum bar agar chart dapat di-scroll
          scrollbar: {
            enabled: true, // Aktifkan scrollbar untuk mengatasi lebih dari 30 data
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1,
            fontColor: 'black', // Menampilkan label bilangan bulat saja (tanpa desimal)
            fontSize: 13,
          }
        }]
      },
      plugins: {
        tooltip: {
          enabled: true
        },
        datalabels: {
          display: true,
          color: 'black',
          textAlign: 'center',
          font: {
            size: 12,
          },
          formatter: (value, context) => {
            if (totalSum !== 0) {
              let label = `${context.chart.data.labels[context.dataIndex]}`;
              return label;
            } else {
              return `${context.chart.data.labels[context.dataIndex]} (0%)`;
            }
          },
        }
      }
    },
    plugins: [ChartDataLabels]
  });


  if (!dataExists) {
    // Hapus chart sebelumnya (jika ada)
    myChart.destroy();
    myPieChart.destroy();
    // Tampilkan pesan jika tidak ada data yang tersedia
    ctx.font = "14px Arial";
    ctx.fillStyle = "black";
    ctx.textAlign = "center";
    ctx.fillText("Tidak ada data yang tersedia.", ctx.canvas.width / 2, ctx.canvas.height / 2);
  }
</script>

<?= $this->endSection('content'); ?>