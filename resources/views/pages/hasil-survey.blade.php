@extends('layouts.app')

@section('navtext')
@include('components.navbar', ['page' => 'Hasil Survey'])
@endsection

@section('navbar')
@include('components.sidenav', ['active' => "hasil-survey", 'survey_data' => ''])
@endsection

@section('content')

<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Question</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $stats['today_questions'] }}
                <span class="text-success text-sm font-weight-bolder">+{{ $stats['today_questions_plus'] }}</span>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Responses</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $stats['today_responses'] }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">New Customers Responding</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $stats['today_customer_responding'] }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Responses</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $stats['total_responses'] }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card z-index-2">
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="chart-bars" class="chart-canvas" style="display: block; box-sizing: border-box; height: 300px; width: 567px;"></canvas>
        </div>
        <h6 class="ms-2 mt-4 mb-0"> Responses </h6>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card z-index-2">
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="chart-line" class="chart-canvas" style="display: block; box-sizing: border-box; height: 300px; width: 567px;"></canvas>
        </div>
        <h6 class="ms-2 mt-4 mb-0"> Pelanggan ITS </h6>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-10">
      <h3>Ringkasan Survei</h3>
    </div>
  </div>
  <div class="row d-flex justify-content-center mb-4">
    <div class="col-11 card z-index-2">
      <div class="card-body p-3">
        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
          <div class="chart">
            <canvas id="chart-bars-avg" class="chart-canvas" height="340" width="770" style="display: block; box-sizing: border-box; height: 170px; width: 385px;"></canvas>
          </div>
        </div>
        <h6 class="ms-2 mt-4 mb-0"> Rata-rata responses </h6>
      </div>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-10">
      <h3>Hasil Survei</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="position-relative border-radius-xl shadow-lg mb-7">
        <div class="overflow-scroll">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" id="data-table">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col" class="col-2">Nomor</th>
                <th scope="col" class="col-9">Jawaban</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($responses as $response) <tr>
                <td class="text-center">
                  {{$response->id}}
                </td>
                <td>
                  <span class="font-weight-bold">{{"Responden : ".$response->customer->name}}</span> <br>
                  {{$response->survey->question}} <br>
                  @if($response->response == '1')
                  <small>Jawaban : Tidak Puas <span class="badge badge-danger">{{$response->response}}</span> </small>
                  @elseif($response->response == '2')
                  <small>Jawaban : Kurang Puas <span class="badge badge-warning">{{$response->response}}</span> </small>
                  @elseif($response->response == '3')
                  <small>Jawaban : Cukup Puas <span class="badge badge-primary">{{$response->response}}</span> </small>
                  @elseif($response->response == '4')
                  <small>Jawaban : Puas <span class="badge badge-info">{{$response->response}}</span> </small>
                  @elseif($response->response == '5')
                  <small>Jawaban : Sangat Puas <span class="badge badge-success">{{$response->response}}</span> </small>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  /*
  var ctx = document.getElementById("chart-bars").getContext("2d");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        <?php echo '"' . $stats['dates'][8] . '"' ?>,
        <?php echo '"' . $stats['dates'][7] . '"' ?>,
        <?php echo '"' . $stats['dates'][6] . '"' ?>,
        <?php echo '"' . $stats['dates'][5] . '"' ?>,
        <?php echo '"' . $stats['dates'][4] . '"' ?>,
        <?php echo '"' . $stats['dates'][3] . '"' ?>,
        <?php echo '"' . $stats['dates'][2] . '"' ?>,
        <?php echo '"' . $stats['dates'][1] . '"' ?>,
        <?php echo '"' . $stats['dates'][0] . '"' ?>
      ],
      datasets: [{
        label: "Responses",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "#fff",
        data: [<?php echo '"' . $stats['graph_responses'][8] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][7] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][6] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][5] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][4] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][3] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][2] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][1] . '"' ?>,
          <?php echo '"' . $stats['graph_responses'][0] . '"' ?>
        ],
        maxBarThickness: 6
      }, ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 500,
            beginAtZero: true,
            padding: 15,
            font: {
              size: 14,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
            color: "#fff"
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false
          },
          ticks: {
            display: false
          },
        },
      },
    },
  }); */

  var ctx = document.getElementById("chart-bars").getContext("2d");

  var gradientStrokev1 = ctx.createLinearGradient(0, 230, 0, 50);

  gradientStrokev1.addColorStop(1, 'rgba(203,12,159,0.2)');
  gradientStrokev1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStrokev1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  var vgradientStroke2 = ctx.createLinearGradient(0, 230, 0, 50);

  vgradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
  vgradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  vgradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

  new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        <?php echo '"' . $stats['dates'][8] . '"' ?>,
        <?php echo '"' . $stats['dates'][7] . '"' ?>,
        <?php echo '"' . $stats['dates'][6] . '"' ?>,
        <?php echo '"' . $stats['dates'][5] . '"' ?>,
        <?php echo '"' . $stats['dates'][4] . '"' ?>,
        <?php echo '"' . $stats['dates'][3] . '"' ?>,
        <?php echo '"' . $stats['dates'][2] . '"' ?>,
        <?php echo '"' . $stats['dates'][1] . '"' ?>,
        <?php echo '"' . $stats['dates'][0] . '"' ?>
      ],
      datasets: [{
          label: "new customers",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 3,
          backgroundColor: gradientStrokev1,
          fill: true,
          data: [<?php echo '"' . $stats['graph_responses'][8] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][7] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][6] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][5] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][4] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][3] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][2] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][1] . '"' ?>,
            <?php echo '"' . $stats['graph_responses'][0] . '"' ?>
          ],
          maxBarThickness: 6

        },
        // {
        //   label: "Websites",
        //   tension: 0.4,
        //   borderWidth: 0,
        //   pointRadius: 0,
        //   borderColor: "#3A416F",
        //   borderWidth: 3,
        //   backgroundColor: gradientStroke2,
        //   fill: true,
        //   data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
        //   maxBarThickness: 6
        // },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });

  var ctx_avg = document.getElementById("chart-bars-avg").getContext("2d");

  new Chart(ctx_avg, {
    type: "bar",
    data: {
      labels: [
        <?php
        foreach ($stats['surveys'] as $survey) {
          echo '"' . $survey->question . '"' . ',';
        }
        ?>,
      ],
      datasets: [{
        label: "Responses",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "#fff",
        data: [
          <?php
          foreach ($stats['surveys'] as $survey) {
            echo '"' . $survey->avg . '"' . ',';
          }
          ?>,
        ],
        maxBarThickness: 6
      }, ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 500,
            beginAtZero: true,
            padding: 15,
            font: {
              size: 14,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
            color: "#fff"
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false
          },
          ticks: {
            display: false
          },
        },
      },
    },
  });

  var ctx2 = document.getElementById("chart-line").getContext("2d");

  var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
  gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

  new Chart(ctx2, {
    type: "line",
    data: {
      labels: [
        <?php echo '"' . $stats['dates'][8] . '"' ?>,
        <?php echo '"' . $stats['dates'][7] . '"' ?>,
        <?php echo '"' . $stats['dates'][6] . '"' ?>,
        <?php echo '"' . $stats['dates'][5] . '"' ?>,
        <?php echo '"' . $stats['dates'][4] . '"' ?>,
        <?php echo '"' . $stats['dates'][3] . '"' ?>,
        <?php echo '"' . $stats['dates'][2] . '"' ?>,
        <?php echo '"' . $stats['dates'][1] . '"' ?>,
        <?php echo '"' . $stats['dates'][0] . '"' ?>
      ],
      datasets: [{
          label: "new customers",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          fill: true,
          data: [<?php echo '"' . $stats['graph_customer'][8] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][7] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][6] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][5] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][4] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][3] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][2] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][1] . '"' ?>,
            <?php echo '"' . $stats['graph_customer'][0] . '"' ?>
          ],
          maxBarThickness: 6

        },
        // {
        //   label: "Websites",
        //   tension: 0.4,
        //   borderWidth: 0,
        //   pointRadius: 0,
        //   borderColor: "#3A416F",
        //   borderWidth: 3,
        //   backgroundColor: gradientStroke2,
        //   fill: true,
        //   data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
        //   maxBarThickness: 6
        // },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>
@endsection