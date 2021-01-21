
$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  var actions = $("table td:last-child").html();
  // Append table with add row form on add new button click
  $(".add-new").click(function () {
    $(this).attr("disabled", "disabled");
    var index = $("table tbody tr:last-child").index();
    var row =
      "<tr>" +
      '<td><input type="text" class="form-control" name="name" id="name"></td>' +
      '<td><input type="text" class="form-control" name="department" id="department"></td>' +
      '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
      '<td><input type="text" class="form-control" name="phone" ></td>' +
      "<td>" +
      actions +
      "</td>" +
      "</tr>";
    $("table").append(row);
    $("table tbody tr")
      .eq(index + 1)
      .find(".add, .edit")
      .toggle();
    $('[data-toggle="tooltip"]').tooltip();
  });
  // Add row on add button click
  $(document).on("click", ".add", function () {
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
    input.each(function () {
      if (!$(this).val()) {
        $(this).addClass("error");
        empty = true;
      } else {
        $(this).removeClass("error");
      }
    });
    $(this).parents("tr").find(".error").first().focus();
    if (!empty) {
      input.each(function () {
        $(this).parent("td").html($(this).val());
      });
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
    }
  });
  // Edit row on edit button click
  $(document).on("click", ".edit", function () {
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function () {
        $(this).html(
          '<input type="text" class="form-control" value="' +
          $(this).text() +
          '">'
        );
      });
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").attr("disabled", "disabled");
  });
  // Delete row on delete button click
  $(document).on("click", ".Suprimmer", function () {
    $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
  });

  // Get Product designation.
  let designation = $('#designation').val();
  let sal_prise = $('#sal_prise').val();
  let qte_enter = $('#qte_enter').val();
  let num_enter = $('#enter_id').val();
  let mag_destination = $('#magasin_id_d').val();
  let table = $('#table_designation');

  let chooser_table = [];
  
  $('#btn_save_stock').on('click', (e) => {
      e.preventDefault();
      let formData = {
          chooser_table: chooser_table,
          num_enter: num_enter,
          motif: $('#enter_motif_id').val(),
          fournisseur: $('#fournisseur').val(),
          magasin_id_o: $('#magasin_id_o').val(),
          date: $('#date').val(),
      }
      console.log(formData);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name=crsf-token').attr('content')
        }
      });
      $.ajax({
        url: 'home',
        type: 'post',
        data: formData,
        dataType: 'json',
        success: function (data) {
          console.log('Data', data);
        },
        error: function (data) {
          console.log('Data', data.responseText);
        }
      });
  });

  $('#add_designation').on('click', (e) => {
      e.preventDefault();
      chooser_table.push({
        designation: designation,
        sal_prise: sal_prise,
        qte_enter: qte_enter,
        num_enter: num_enter,
        mag_destination: mag_destination,
      });
      let tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${designation}</td>
        <td>${sal_prise}</td>
        <td>${qte_enter}</td>
        <td>${mag_destination}</td>
        <td></td>
      `;
      table.children('tbody').append(tr);
      
  });
});


(function ($) {
  "use strict";
  /*-------------------------------------
      Sidebar Toggle Menu
    -------------------------------------*/
  $(".sidebar-toggle-view").on(
    "click",
    ".sidebar-nav-item .nav-link",
    function (e) {
      if (!$(this).parents("#wrapper").hasClass("sidebar-collapsed")) {
        var animationSpeed = 300,
          subMenuSelector = ".sub-group-menu",
          $this = $(this),
          checkElement = $this.next();
        if (checkElement.is(subMenuSelector) && checkElement.is(":visible")) {
          checkElement.slideUp(animationSpeed, function () {
            checkElement.removeClass("menu-open");
          });
          checkElement.parent(".sidebar-nav-item").removeClass("active");
        } else if (
          checkElement.is(subMenuSelector) &&
          !checkElement.is(":visible")
        ) {
          var parent = $this.parents("ul").first();
          var ul = parent.find("ul:visible").slideUp(animationSpeed);
          ul.removeClass("menu-open");
          var parent_li = $this.parent("li");
          checkElement.slideDown(animationSpeed, function () {
            checkElement.addClass("menu-open");
            parent.find(".sidebar-nav-item.active").removeClass("active");
            parent_li.addClass("active");
          });
        }
        if (checkElement.is(subMenuSelector)) {
          e.preventDefault();
        }
      } else {
        if ($(this).attr("href") === "#") {
          e.preventDefault();
        }
      }
    }
  );

  /*-------------------------------------
      Sidebar Menu Control
    -------------------------------------*/
  $(".sidebar-toggle").on("click", function () {
    window.setTimeout(function () {
      $("#wrapper").toggleClass("sidebar-collapsed");
    }, 500);
  });

  /*-------------------------------------
      Sidebar Menu Control Mobile
    -------------------------------------*/
  $(".sidebar-toggle-mobile").on("click", function () {
    $("#wrapper").toggleClass("sidebar-collapsed-mobile");
    if ($("#wrapper").hasClass("sidebar-collapsed")) {
      $("#wrapper").removeClass("sidebar-collapsed");
    }
  });

  /*-------------------------------------
      jquery Scollup activation code
   -------------------------------------*/
  $.scrollUp({
    scrollText: '<i class="fa fa-angle-up"></i>',
    easingType: "linear",
    scrollSpeed: 900,
    animation: "fade",
  });

  /*-------------------------------------
      jquery Scollup activation code
    -------------------------------------*/
  $("#preloader").fadeOut("slow", function () {
    $(this).remove();
  });

  $(function () {
    if ($.fn.DataTable !== undefined) {
      $('.data-table').DataTable({
        paging: true,
        searching: true,
        responsive: true,
        info: true, 
        dom: 'Bfrtip',
          buttons: [
           'excel', 'pdf', 'print'
          ],
        lengthChange: false,
        lengthMenu: [20, 50, 75, 100],
        columnDefs: [{
          targets: [0, -1], // column or columns numbers
          orderable: false // set orderable for selected columns
        }],
      });
    }


    /*-------------------------------------
          Data Table init
          
      -------------------------------------*

    /*-------------------------------------
          All Checkbox Checked
      -------------------------------------*/
    $(".checkAll").on("click", function () {
      $(this)
        .parents(".table")
        .find("input:checkbox")
        .prop("checked", this.checked);
    });

    /*-------------------------------------
          Tooltip init
      -------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();

    /*-------------------------------------
          Select 2 Init
      -------------------------------------*/
    if ($.fn.select2 !== undefined) {
      $(".select2").select2({
        width: "100%",
      });
    }

    /*-------------------------------------
          Date Picker
      -------------------------------------*/
    if ($.fn.datepicker !== undefined) {
      $(".air-datepicker").datepicker({
        language: {
          days: [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
          ],
          daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
          daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
          months: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ],
          monthsShort: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          today: "Today",
          clear: "Clear",
          dateFormat: "dd/mm/yyyy",
          firstDay: 0,
        },
      });
    }

    /*-------------------------------------
          Counter
      -------------------------------------*/
    var counterContainer = $(".counter");
    if (counterContainer.length) {
      counterContainer.counterUp({
        delay: 50,
        time: 1000,
      });
    }

    /*-------------------------------------
          Line Chart 
      -------------------------------------*/
    if ($("#earning-line-chart").length) {
      var lineChartData = {
        labels: ["", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", ""],
        datasets: [{
            data: [0, 5e4, 1e4, 5e4, 14e3, 7e4, 5e4, 75e3, 5e4],
            backgroundColor: "#ff0000",
            borderColor: "#ff0000",
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: "#ff0000",
            pointBorderColor: "#ffffff",
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: "origin",
            label: "Total Collection",
          },
          {
            data: [0, 3e4, 2e4, 6e4, 7e4, 5e4, 5e4, 9e4, 8e4],
            backgroundColor: "#417dfc",
            borderColor: "#417dfc",
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: "#304ffe",
            pointBorderColor: "#ffffff",
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: "origin",
            label: "Fees Collection",
          },
        ],
      };
      var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 2000,
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              display: true,
              fontColor: "#222222",
              fontSize: 16,
              padding: 20,
            },
            gridLines: {
              display: true,
              drawBorder: true,
              color: "#cccccc",
              borderDash: [5, 5],
            },
          }, ],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: true,
              maxRotation: 0,
              fontColor: "#646464",
              fontSize: 16,
              stepSize: 25000,
              padding: 20,
              callback: function (value) {
                var ranges = [{
                    divider: 1e6,
                    suffix: "M",
                  },
                  {
                    divider: 1e3,
                    suffix: "k",
                  },
                ];

                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (
                        (n / ranges[i].divider).toString() + ranges[i].suffix
                      );
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              },
            },
            gridLines: {
              display: true,
              drawBorder: false,
              color: "#cccccc",
              borderDash: [5, 5],
              zeroLineBorderDash: [5, 5],
            },
          }, ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          mode: "index",
          intersect: false,
          enabled: true,
        },
        elements: {
          line: {
            tension: 0.35,
          },
          point: {
            pointStyle: "circle",
          },
        },
      };
      var earningCanvas = $("#earning-line-chart").get(0).getContext("2d");
      var earningChart = new Chart(earningCanvas, {
        type: "line",
        data: lineChartData,
        options: lineChartOptions,
      });
    }

    /*-------------------------------------
          Bar Chart 
      -------------------------------------*/
    if ($("#expense-bar-chart").length) {
      var barChartData = {
        labels: ["Jan", "Feb", "Mar"],
        datasets: [{
          backgroundColor: ["#40dfcd", "#417dfc", "#ffaa01"],
          data: [125000, 100000, 75000, 50000, 150000],
          label: "Expenses (millions)",
        }, ],
      };
      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 2000,
        },
        scales: {
          xAxes: [{
            display: false,
            maxBarThickness: 100,
            ticks: {
              display: false,
              padding: 0,
              fontColor: "#646464",
              fontSize: 14,
            },
            gridLines: {
              display: true,
              color: "#e1e1e1",
            },
          }, ],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              fontColor: "#646464",
              fontSize: 14,
              stepSize: 25000,
              padding: 20,
              beginAtZero: true,
              callback: function (value) {
                var ranges = [{
                    divider: 1e6,
                    suffix: "M",
                  },
                  {
                    divider: 1e3,
                    suffix: "k",
                  },
                ];

                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (
                        (n / ranges[i].divider).toString() + ranges[i].suffix
                      );
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              },
            },
            gridLines: {
              display: true,
              drawBorder: true,
              color: "#e1e1e1",
              zeroLineColor: "#e1e1e1",
            },
          }, ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          enabled: true,
        },
        elements: {},
      };
      var expenseCanvas = $("#expense-bar-chart").get(0).getContext("2d");
      var expenseChart = new Chart(expenseCanvas, {
        type: "bar",
        data: barChartData,
        options: barChartOptions,
      });
    }
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

    /*-------------------------------------
          Doughnut Chart 
      -------------------------------------*/
    if ($("#student-doughnut-chart").length) {
      var doughnutChartData = {
        labels: ["Female Students", "Male Students"],
        datasets: [{
          backgroundColor: ["#304ffe", "#ffa601"],
          data: [45000, 105000],
          label: "Total Students",
        }, ],
      };
      var doughnutChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 65,
        rotation: -9.4,
        animation: {
          duration: 2000,
        },
        legend: {
          display: false,
        },
        tooltips: {
          enabled: true,
        },
      };
      var studentCanvas = $("#student-doughnut-chart").get(0).getContext("2d");
      var studentChart = new Chart(studentCanvas, {
        type: "doughnut",
        data: doughnutChartData,
        options: doughnutChartOptions,
      });
    }

    /*-------------------------------------
          Calender initiate 
      -------------------------------------*/
    if ($.fn.fullCalendar !== undefined) {
      $("#fc-calender").fullCalendar({
        header: {
          center: "basicDay,basicWeek,month",
          left: "title",
          right: "prev,next",
        },
        fixedWeekCount: false,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        aspectRatio: 1.8,
        events: [{
            title: "All Day Event",
            start: "2019-04-01",
          },

          {
            title: "Meeting",
            start: "2019-04-12T14:30:00",
          },
          {
            title: "Happy Hour",
            start: "2019-04-15T17:30:00",
          },
          {
            title: "Birthday Party",
            start: "2019-04-20T07:00:00",
          },
        ],
      });
    }
  });
})(jQuery);