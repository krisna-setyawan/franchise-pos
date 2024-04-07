<div class="page-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-lg-3 col-sm-6 col-12">
				<div class="dash-widget">
					<div class="dash-widgetimg">
						<span><img src="<?= base_url() ?>assets/template/assets/img/icons/dash1.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5>Rp. <span class="counters"><?= number_format($sum_grand_total_pjl_online['grand_total'], 0, ',', '.') ?></span></h5>
						<h6><?= $count_pjl_online ?> Invoice Penjualan Online</h6>
						<h6>Bulan <?= date('m') ?> Tahun <?= date('Y') ?></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12">
				<div class="dash-widget dash1">
					<div class="dash-widgetimg">
						<span><img src="<?= base_url() ?>assets/template/assets/img/icons/dash2.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5>Rp. <span class="counters"><?= number_format($sum_grand_total_pjl_outlet['grand_total'], 0, ',', '.') ?></span></h5>
						<h6><?= $count_pjl_outlet ?> Invoice Penjualan Outlet</h6>
						<h6>Bulan <?= date('m') ?> Tahun <?= date('Y') ?></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12">
				<div class="dash-widget dash2">
					<div class="dash-widgetimg">
						<span><img src="<?= base_url() ?>assets/template/assets/img/icons/dash3.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5><span class="counters"><?= $count_inbound ?> Transaksi</span></h5>
						<h6>Inbound</h6>
						<h6>Bulan <?= date('m') ?> Tahun <?= date('Y') ?></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12">
				<div class="dash-widget dash3">
					<div class="dash-widgetimg">
						<span><img src="<?= base_url() ?>assets/template/assets/img/icons/dash4.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5><span class="counters"><?= $count_outbound ?> Transaksi</span></h5>
						<h6>Outbound</h6>
						<h6>Bulan <?= date('m') ?> Tahun <?= date('Y') ?></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count">
					<div class="dash-counts">
						<h4><?= $count_karyawan ?></h4>
						<h5>Karyawan</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="user"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das1">
					<div class="dash-counts">
						<h4><?= $count_customer ?></h4>
						<h5>Customer</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="user-check"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das2">
					<div class="dash-counts">
						<h4><?= $count_produk ?></h4>
						<h5>Produk</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das3">
					<div class="dash-counts">
						<h4><?= $count_jasa ?></h4>
						<h5>Jasa</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-12 col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header pb-0 d-flex justify-content-between align-items-center">
						<h5 class="card-title mb-0">Penjualan Online & Outlet tahun <?= date('Y') ?></h5>
					</div>
					<div class="card-body">
						<div id="s-line" class="chart-set"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-12 d-flex">
				<div class="card flex-fill">
					<div class="card-header pb-0 d-flex justify-content-between align-items-center">
						<h5 class="card-title mb-0 text-center">Penjualan Outlet <?= date('m') ?>/<?= date('Y') ?></h5>
					</div>
					<div class="card-body">
						<div id="donut-chart" class="chart-set"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script>
	if ($('#s-line').length > 0) {
		var sline = {
			chart: {
				height: 350,
				type: 'line',
				zoom: {
					enabled: false
				},
				toolbar: {
					show: false,
				}
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'straight'
			},
			series: [{
				name: "Total Penjualan",
				data: <?php echo json_encode(array_values($penjualan_setahun)); ?>
			}],
			grid: {
				row: {
					colors: ['#f1f2f3', 'transparent'],
					opacity: 0.5
				},
			},
			xaxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
			}
		}
		var chart = new ApexCharts(document.querySelector("#s-line"), sline);
		chart.render();
	}



	if ($('#donut-chart').length > 0) {
		var donutChart = {
			chart: {
				height: 350,
				type: 'donut',
				toolbar: {
					show: false,
				}
			},
			series: [<?= $penjualan_outlet_dg_jasa['jumlah_dengan_jasa'] ?>, <?= $penjualan_outlet_dg_jasa['jumlah_tanpa_jasa'] ?>],
			labels: ['Dengan Jasa', 'Tanpa Jasa'], // Tambahkan label-label di sini
			colors: ['#1ab7ea', '#0084ff'], // Atur warna-warna di sini
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}]
		}
		var donut = new ApexCharts(document.querySelector("#donut-chart"), donutChart);
		donut.render();
	}
</script>