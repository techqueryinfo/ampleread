@extends('layouts.admin')
@section('content')
<!-- stat page -->
<div class="stat-container">
<!-- stat page one -->
<div class="stat-one">
    <div class="stat-one-left">
        <div class="row-stat">
            <div class="unit-stat-one">
                <div class="heading">Free Users
                    Signed Up</div>
                <div class="day">Today <i class="fa fa-angle-down"></i></div>
                <div class="date free-signup">{{$free_user}}</div>
            </div>
            <div class="unit-stat-one">
                <div class="heading">Paid Users
                    Signed Up</div>
                <div class="day">This Month <i class="fa fa-angle-down"></i></div>
                <div class="date paid-signup">{{$paid_user}}</div>
            </div>
        </div>
        <div class="row-stat">
            <div class="unit-stat-one">
                <div class="heading">Paid eBooks</div>
                <div class="day">Today <i class="fa fa-angle-down"></i></div>
                <div class="date paid-ebook">{{$paid_book}}</div>
            </div>
            <div class="unit-stat-one">
                <div class="heading">Free Books</div>
                <div class="day">Lifetime <i class="fa fa-angle-down"></i></div>
                <div class="date book-created">{{$free_book}}</div>
            </div>
        </div>
    </div>
    <div class="stat-one-right">
        <div class="chart">
        <div id="chartdiv"></div>
        </div>
        <div class="stat-footer">
            <div class="stat-left">
                <div class="ratio women">{{floor($free_user/($free_user+$paid_user)*100)}}%</div>
                <div class="zender">Free</div>
            </div>
            <div class="stat-right">
                <div class="ratio men">{{ceil($paid_user/($free_user+$paid_user)*100)}}%</div>
                <div class="zender">Paid</div>
            </div>
        </div>
    </div>
</div>
<!-- stat page two -->
<div class="stat-two">
  <div class="stat-two-section">
      <div class="stat-two-section-head">
          <div class="head-icon">
              <i class="fas fa-eye"></i>
          </div>
          <div class="head-content">
              Most viewed books
          </div>
      </div>
      <div class="stat-two-section-body">
          <div class="unit-content">
              <div class="left">
                  <div class="one">1. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">2. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">3. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">4. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">5. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">6. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
      </div>
  </div>
  <div class="stat-two-section margin-left-20">
      <div class="stat-two-section-head">
          <div class="head-icon">
              <i class="fas fa-book"></i>
          </div>
          <div class="head-content">
              Most Read books
          </div>
      </div>
      <div class="stat-two-section-body">
          <div class="unit-content">
              <div class="left">
                  <div class="one">1. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">2. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">3. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">4. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">5. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">6. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
      </div>
  </div>
  <div class="stat-two-section margin-left-20">
      <div class="stat-two-section-head">
          <div class="head-icon">
              <i class="fa fa-download" aria-hidden="true"></i>
          </div>
          <div class="head-content">
              Most downloaded books
          </div>
      </div>
      <div class="stat-two-section-body">
          <div class="unit-content">
              <div class="left">
                  <div class="one">1. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">2. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">3. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">4. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">5. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
          <div class="unit-content">
              <div class="left">
                  <div class="one">6. The Ministry of Ut…</div>
                  <div class="two">Arundhati Roy</div>
              </div>
              <div class="right">
                  <i class="fas fa-eye"></i><span>2,500</span>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- stat page three -->
<div class="stat-three">
<div class="stat-three-section">
            <div class="stat-three-section-head">
                <div class="head-content">
                    Traffic by devices
                </div>
            </div>
            <div class="stat-three-section-body">
             <div class="chart">
                 <div id="xycharts"></div>
             </div>
             <div class="content">
                 <div class="row">
                     <div class="left">Total visits</div>
                     <div class="right">112,9 M</div>
                 </div>
                 <div class="row">
                     <div class="left">Avg. visit duration</div>
                     <div class="right">00:03:43</div>
                 </div>
                 <div class="row">
                     <div class="left">Pages per visit</div>
                     <div class="right">4.39</div>
                 </div>
                 <div class="row">
                     <div class="left">Bounce rate</div>
                     <div class="right">52.80%</div>
                 </div>
             </div>
            </div>
        </div>
</div>
<!-- stat page four -->
<div class="stat-three">
        <div class="stat-three-section">
            <div class="stat-three-section-head">
                <div class="head-content">
                    Traffic by country
                </div>
            </div>
            <div class="stat-three-section-body">
                <div class="chart">
                    <div id="mapchart"></div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="left"><img src="../images/flag/india.jpg" alt=""/> INDIA</div>
                        <div class="right">37.09%

                            <div class="downgrade"><i class="fas fa-angle-down"></i> 0.54%</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="left"><img src="../images/flag/us.jpg" alt=""/> USA</div>
                        <div class="right">37.09%

                            <div class="downgrade"><i class="fas fa-angle-down"></i> 0.54%</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="left"><img src="../images/flag/canada.jpg" alt=""/> CANADA</div>
                        <div class="right">37.09%

                            <div class="upgrade"><i class="fas fa-angle-up"></i> 0.54%</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<!-- stat page five -->
<div class="stat-three">
        <div class="stat-three-section">
            <div class="stat-three-section-head">
                <div class="head-content">
                    Traffic stats
                </div>
            </div>
            <div class="stat-three-section-body">
                <div class="chart traficstat">
                    <div id="traficstat"></div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- end stat page-->
@endsection
@section('footer_scripts')
<script>
            var chart = AmCharts.makeChart( "chartdiv", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [ {
                    "title": "Free",
                    "value": "{{$free_user}}"
                }, {
                    "title": "Paid",
                    "value": "{{$paid_user}}"
                } ],
                "titleField": "title",
                "valueField": "value",
                "labelRadius": 5,

                "radius": "42%",
                "innerRadius": "60%",
                "labelText": "[[title]]",
                "export": {
                    "enabled": true
                }
            } );
        </script>
        <script type="text/javascript">
            var map = AmCharts.makeChart("mapchart",{
                type: "map",
                theme: "dark",
                projection: "mercator",
                panEventsEnabled : true,
                backgroundColor : "transparent",
                backgroundAlpha : 1,
                zoomControl: {
                    zoomControlEnabled : true
                },
                dataProvider : {
                    map : "worldHigh",
                    getAreasFromMap : true,
                    areas :
                    []
                },
                areasSettings : {
                    autoZoom : true,
                    color : "#78c0e5",
                    colorSolid : "#84ADE9",
                    selectedColor : "#84ADE9",
                    outlineColor : "#666666",
                    rollOverColor : "#9EC2F7",
                    rollOverOutlineColor : "#000000"
                }
            });
        </script>
<script>
    var chart = AmCharts.makeChart("xycharts", {
        "type": "xy",
        "theme": "light",
        "marginRight": 80,
        "dataDateFormat": "YYYY-MM-DD",
        "startDuration": 1.5,
        "trendLines": [],
        "balloon": {
            "adjustBorderColor": false,
            "shadowAlpha": 0,
            "fixedPosition": true
        },
        "graphs": [{
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>y:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "diamond",
            "maxBulletSize": 25,
            "lineAlpha": 0.8,
            "lineThickness": 2,
            "lineColor": "#b0de09",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "ay",
            "valueField": "aValue"
        }, {
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>y:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "round",
            "maxBulletSize": 25,
            "lineAlpha": 0.8,
            "lineThickness": 2,
            "lineColor": "#fcd202",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "by",
            "valueField": "bValue"
        }],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "axisAlpha": 0
        }, {
            "id": "ValueAxis-2",
            "axisAlpha": 0,
            "position": "bottom"
        }],
        "allLabels": [],
        "titles": [],
        "dataProvider": [{
            "date": 1,
            "ay": 6.5,
            "by": 2.2,
            "aValue": 15,
            "bValue": 10
        }, {
            "date": 2,
            "ay": 12.3,
            "by": 4.9,
            "aValue": 8,
            "bValue": 3
        }, {
            "date": 3,
            "ay": 12.3,
            "by": 5.1,
            "aValue": 16,
            "bValue": 4
        }, {
            "date": 5,
            "ay": 2.9,
            "aValue": 9
        }, {
            "date": 7,
            "by": 8.3,
            "bValue": 13
        }, {
            "date": 10,
            "ay": 2.8,
            "by": 13.3,
            "aValue": 9,
            "bValue": 13
        }, {
            "date": 12,
            "ay": 3.5,
            "by": 6.1,
            "aValue": 5,
            "bValue": 2
        }, {
            "date": 13,
            "ay": 5.1,
            "aValue": 10
        }, {
            "date": 15,
            "ay": 6.7,
            "by": 10.5,
            "aValue": 3,
            "bValue": 10
        }, {
            "date": 16,
            "ay": 8,
            "by": 12.3,
            "aValue": 5,
            "bValue": 13
        }, {
            "date": 20,
            "by": 4.5,
            "bValue": 11
        }, {
            "date": 22,
            "ay": 9.7,
            "by": 15,
            "aValue": 15,
            "bValue": 10
        }, {
            "date": 23,
            "ay": 10.4,
            "by": 10.8,
            "aValue": 1,
            "bValue": 11
        }, {
            "date": 24,
            "ay": 1.7,
            "by": 19,
            "aValue": 12,
            "bValue": 3
        }],
        "chartCursor": {
            "pan": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0
        }
    });
</script>
<script>
    var chart = AmCharts.makeChart("traficstat", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": [{
            "country": "Mail",
            "visits": 3025,
            "color": "#8ea1b2"
        }, {
            "country": "Paid search campaign",
            "visits": 1882,
            "color": "#8ea1b2"
        }, {
            "country": "Social media",
            "visits": 1809,
            "color": "#8ea1b2"
        }, {
            "country": "Referrals",
            "visits": 1322,
            "color": "#8ea1b2"
        }, {
            "country": "Display ads",
            "visits": 1122,
            "color": "#8ea1b2"
        }, {
            "country": "Direct search",
            "visits": 1114,
            "color": "#8ea1b2"
        }, ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": ""
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
    });
</script>
@endsection