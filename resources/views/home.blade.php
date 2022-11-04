@extends('layouts.sidebar')

@section('content')

<h2>Laporan Grafik
    @if($month >= 1 && $month <= 3)
        Triwulan I (Januari - Maret {{$year}})
    @elseif($month >= 4 && $month <= 6)
        Triwulan II (April - Juni {{$year}})
    @elseif($month >= 7 && $month <= 9)
        Triwulan III (Juli - September {{$year}})
    @elseif($month >= 10 && $month <= 12)
        Triwulan IV (Oktober - Desember {{$year}})
    @endif    
</h2>
<div class="mt-4">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">

                <h5 class="card-title">Statistik FTB (Approved)</h5>
                <canvas id="chartCurrIn"></canvas>

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Statistik FKB (Approved)</h5>
                <canvas id="chartCurrOut"></canvas>
                
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
        var color = ['#EA047E','#FF6D28','#38E54D','#2192FF','#400D51','#F55353','#000D6B','#E14D2A','#FF1700','#2E0249',
                     '#A91079','#FF5403'];
        var colorOut = ['#EA047E','#FF6D28','#38E54D','#2192FF','#400D51','#F55353','#000D6B','#E14D2A','#FF1700','#2E0249','#A91079','#FF5403'];
      
        var label = <?php echo json_encode($label); ?>;

      

        const data = {
            labels: <?php echo json_encode($label); ?>,
            datasets: [
                {
                    
                    data: <?php echo json_encode($flowInCurr); ?>,
                    backgroundColor: color,
                    borderColor: color,
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    borderWidth: 1
                }
            ]
        };

        const dataOut = {
            labels: <?php echo json_encode($label); ?>,
            datasets: [
                {
                    
                    data: <?php echo json_encode($flowOutCurr); ?>,
                    backgroundColor: colorOut,
                    borderColor: colorOut,
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    borderWidth: 1
                }
            ]
        };

        // konfigurasi data
        const configIn = {
            type: 'pie',
            data,
            options: {
                plugins:{
                    labels:{
                        render: 'value',
                        fontColor: '#fff',
                        fontSize: 16,
                        fontFamily:'Poppins',
                        textShadow: true,
                        shadowColor: 'rgba(255,0,0,0.75)'
                    }
                }
            }
        };
        const configOut = {
            type: 'pie',
            data: dataOut,
            options: {
                plugins:{
                    labels:{
                        render: 'value',
                        fontColor: '#fff',
                        fontSize: 16,
                        fontFamily:'Poppins',
                        textShadow: true,
                        shadowColor: 'rgba(255,0,0,0.75)'
                    }
                }
            }
        };

        // render grafik
        const chartCurrIn = new Chart(document.getElementById('chartCurrIn'), configIn);
        const chartCurrOut = new Chart(document.getElementById('chartCurrOut'), configOut);
</script>







@endsection








