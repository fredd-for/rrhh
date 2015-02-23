/**
* @version: 1.2
* @author: Dan Grossman http://www.dangrossman.info/
* @date: 2013-07-25
* @copyright: Copyright (c) 2012-2013 Dan Grossman. All rights reserved.
* @license: Licensed under Apache License v2.0. See http://www.apache.org/licenses/LICENSE-2.0
* @website: http://www.improvely.com/
*/

!function(a){var b=function(b,c,d){var f,e="object"==typeof c;this.startDate=moment().startOf("day"),this.endDate=moment().startOf("day"),this.minDate=!1,this.maxDate=!1,this.dateLimit=!1,this.showDropdowns=!1,this.showWeekNumbers=!1,this.timePicker=!1,this.timePickerIncrement=30,this.timePicker12Hour=!0,this.ranges={},this.opens="right",this.buttonClasses=["btn","btn-small"],this.applyClass="btn-success",this.cancelClass="btn-default",this.format="MM/DD/YYYY",this.separator=" - ",this.locale={applyLabel:"Apply",cancelLabel:"Cancel",fromLabel:"From",toLabel:"To",weekLabel:"W",customRangeLabel:"Custom Range",daysOfWeek:moment()._lang._weekdaysMin.slice(),monthNames:moment()._lang._monthsShort.slice(),firstDay:0},this.cb=function(){},this.parentEl="body",this.element=a(b),this.element.hasClass("pull-right")&&(this.opens="left"),this.element.is("input")?this.element.on({click:a.proxy(this.show,this),focus:a.proxy(this.show,this)}):this.element.on("click",a.proxy(this.show,this)),f=this.locale,e&&("object"==typeof c.locale&&a.each(f,function(a,b){f[a]=c.locale[a]||b}),c.applyClass&&(this.applyClass=c.applyClass),c.cancelClass&&(this.cancelClass=c.cancelClass));var g='<div class="daterangepicker dropdown-menu"><div class="calendar left"></div><div class="calendar right"></div><div class="ranges"><div class="range_inputs"><div class="daterangepicker_start_input" style="float: left"><label for="daterangepicker_start">'+this.locale.fromLabel+"</label>"+'<input class="input-mini" type="text" name="daterangepicker_start" value="" disabled="disabled" />'+"</div>"+'<div class="daterangepicker_end_input" style="float: left;">'+'<label for="daterangepicker_end">'+this.locale.toLabel+"</label>"+'<input class="input-mini" type="text" name="daterangepicker_end" value="" disabled="disabled" />'+"</div>"+'<div class="btn-toolbar">'+'<button class="'+this.applyClass+' applyBtn" disabled="disabled">'+this.locale.applyLabel+"</button>&nbsp;"+'<button class="'+this.cancelClass+' cancelBtn">'+this.locale.cancelLabel+"</button>"+"</div>"+"</div>"+"</div>"+"</div>";if(this.parentEl=e&&c.parentEl&&a(c.parentEl)||a(this.parentEl),this.container=a(g).appendTo(this.parentEl),e){if("string"==typeof c.format&&(this.format=c.format),"string"==typeof c.separator&&(this.separator=c.separator),"string"==typeof c.startDate&&(this.startDate=moment(c.startDate,this.format)),"string"==typeof c.endDate&&(this.endDate=moment(c.endDate,this.format)),"string"==typeof c.minDate&&(this.minDate=moment(c.minDate,this.format)),"string"==typeof c.maxDate&&(this.maxDate=moment(c.maxDate,this.format)),"object"==typeof c.startDate&&(this.startDate=moment(c.startDate)),"object"==typeof c.endDate&&(this.endDate=moment(c.endDate)),"object"==typeof c.minDate&&(this.minDate=moment(c.minDate)),"object"==typeof c.maxDate&&(this.maxDate=moment(c.maxDate)),"object"==typeof c.ranges){for(var h in c.ranges){var i=moment(c.ranges[h][0]),j=moment(c.ranges[h][1]);this.minDate&&i.isBefore(this.minDate)&&(i=moment(this.minDate)),this.maxDate&&j.isAfter(this.maxDate)&&(j=moment(this.maxDate)),this.minDate&&j.isBefore(this.minDate)||this.maxDate&&i.isAfter(this.maxDate)||(this.ranges[h]=[i,j])}var k="<ul>";for(var h in this.ranges)k+="<li>"+h+"</li>";k+="<li>"+this.locale.customRangeLabel+"</li>",k+="</ul>",this.container.find(".ranges").prepend(k)}if("object"==typeof c.dateLimit&&(this.dateLimit=c.dateLimit),"object"==typeof c.locale&&"number"==typeof c.locale.firstDay){this.locale.firstDay=c.locale.firstDay;for(var l=c.locale.firstDay;l>0;)this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift()),l--}"string"==typeof c.opens&&(this.opens=c.opens),"boolean"==typeof c.showWeekNumbers&&(this.showWeekNumbers=c.showWeekNumbers),"string"==typeof c.buttonClasses&&(this.buttonClasses=[c.buttonClasses]),"object"==typeof c.buttonClasses&&(this.buttonClasses=c.buttonClasses),"boolean"==typeof c.showDropdowns&&(this.showDropdowns=c.showDropdowns),"boolean"==typeof c.timePicker&&(this.timePicker=c.timePicker),"number"==typeof c.timePickerIncrement&&(this.timePickerIncrement=c.timePickerIncrement),"boolean"==typeof c.timePicker12Hour&&(this.timePicker12Hour=c.timePicker12Hour)}this.timePicker||(this.startDate=this.startDate.startOf("day"),this.endDate=this.endDate.startOf("day"));var m=this.container;if(a.each(this.buttonClasses,function(a,b){m.find("button").addClass(b)}),"right"==this.opens){var n=this.container.find(".calendar.left"),o=this.container.find(".calendar.right");n.removeClass("left").addClass("right"),o.removeClass("right").addClass("left")}if(("undefined"==typeof c||"undefined"==typeof c.ranges)&&(this.container.find(".calendar").show(),this.move()),"function"==typeof d&&(this.cb=d),this.container.addClass("opens"+this.opens),(!e||"undefined"==typeof c.startDate&&"undefined"==typeof c.endDate)&&a(this.element).is("input[type=text]")){var i,j,p=a(this.element).val(),q=p.split(this.separator);2==q.length&&(i=moment(q[0],this.format),j=moment(q[1],this.format)),null!=i&&null!=j&&(this.startDate=i,this.endDate=j)}this.oldStartDate=this.startDate.clone(),this.oldEndDate=this.endDate.clone(),this.leftCalendar={month:moment([this.startDate.year(),this.startDate.month(),1,this.startDate.hour(),this.startDate.minute()]),calendar:[]},this.rightCalendar={month:moment([this.endDate.year(),this.endDate.month(),1,this.endDate.hour(),this.endDate.minute()]),calendar:[]},this.container.on("mousedown",a.proxy(this.mousedown,this)),this.container.find(".calendar").on("click",".prev",a.proxy(this.clickPrev,this)),this.container.find(".calendar").on("click",".next",a.proxy(this.clickNext,this)),this.container.find(".ranges").on("click","button.applyBtn",a.proxy(this.clickApply,this)),this.container.find(".ranges").on("click","button.cancelBtn",a.proxy(this.clickCancel,this)),this.container.find(".ranges").on("click",".daterangepicker_start_input",a.proxy(this.showCalendars,this)),this.container.find(".ranges").on("click",".daterangepicker_end_input",a.proxy(this.showCalendars,this)),this.container.find(".calendar").on("click","td.available",a.proxy(this.clickDate,this)),this.container.find(".calendar").on("mouseenter","td.available",a.proxy(this.enterDate,this)),this.container.find(".calendar").on("mouseleave","td.available",a.proxy(this.updateView,this)),this.container.find(".ranges").on("click","li",a.proxy(this.clickRange,this)),this.container.find(".ranges").on("mouseenter","li",a.proxy(this.enterRange,this)),this.container.find(".ranges").on("mouseleave","li",a.proxy(this.updateView,this)),this.container.find(".calendar").on("change","select.yearselect",a.proxy(this.updateMonthYear,this)),this.container.find(".calendar").on("change","select.monthselect",a.proxy(this.updateMonthYear,this)),this.container.find(".calendar").on("change","select.hourselect",a.proxy(this.updateTime,this)),this.container.find(".calendar").on("change","select.minuteselect",a.proxy(this.updateTime,this)),this.container.find(".calendar").on("change","select.ampmselect",a.proxy(this.updateTime,this)),this.element.on("keyup",a.proxy(this.updateFromControl,this)),this.updateView(),this.updateCalendars()};b.prototype={constructor:b,mousedown:function(a){a.stopPropagation()},updateView:function(){this.leftCalendar.month.month(this.startDate.month()).year(this.startDate.year()),this.rightCalendar.month.month(this.endDate.month()).year(this.endDate.year()),this.container.find("input[name=daterangepicker_start]").val(this.startDate.format(this.format)),this.container.find("input[name=daterangepicker_end]").val(this.endDate.format(this.format)),this.startDate.isSame(this.endDate)||this.startDate.isBefore(this.endDate)?this.container.find("button.applyBtn").removeAttr("disabled"):this.container.find("button.applyBtn").attr("disabled","disabled")},updateFromControl:function(){if(this.element.is("input")&&this.element.val().length){var a=this.element.val().split(this.separator),b=moment(a[0],this.format),c=moment(a[1],this.format);null!=b&&null!=c&&(c.isBefore(b)||(this.startDate=b,this.endDate=c,this.notify(),this.updateCalendars()))}},notify:function(){this.updateView(),this.cb(this.startDate,this.endDate)},move:function(){var b={top:this.parentEl.offset().top-(this.parentEl.is("body")?0:this.parentEl.scrollTop()),left:this.parentEl.offset().left-(this.parentEl.is("body")?0:this.parentEl.scrollLeft())};"left"==this.opens?(this.container.css({top:this.element.offset().top+this.element.outerHeight()-b.top,right:a(window).width()-this.element.offset().left-this.element.outerWidth()-b.left,left:"auto"}),this.container.offset().left<0&&this.container.css({right:"auto",left:9})):(this.container.css({top:this.element.offset().top+this.element.outerHeight()-b.top,left:this.element.offset().left-b.left,right:"auto"}),this.container.offset().left+this.container.outerWidth()>a(window).width()&&this.container.css({left:"auto",right:0}))},show:function(b){this.container.show(),this.move(),b&&(b.stopPropagation(),b.preventDefault()),a(document).on("mousedown",a.proxy(this.hide,this)),this.element.trigger("shown",{target:b.target,picker:this})},hide:function(){this.container.hide(),this.startDate.isSame(this.oldStartDate)&&this.endDate.isSame(this.oldEndDate)||this.notify(),this.oldStartDate=this.startDate.clone(),this.oldEndDate=this.endDate.clone(),a(document).off("mousedown",this.hide),this.element.trigger("hidden",{picker:this})},enterRange:function(a){var b=a.target.innerHTML;if(b==this.locale.customRangeLabel)this.updateView();else{var c=this.ranges[b];this.container.find("input[name=daterangepicker_start]").val(c[0].format(this.format)),this.container.find("input[name=daterangepicker_end]").val(c[1].format(this.format))}},showCalendars:function(){this.container.find(".calendar").show(),this.move()},updateInputText:function(){this.element.is("input")&&this.element.val(this.startDate.format(this.format)+this.separator+this.endDate.format(this.format))},clickRange:function(a){var b=a.target.innerHTML;if(b==this.locale.customRangeLabel)this.showCalendars();else{var c=this.ranges[b];this.startDate=c[0],this.endDate=c[1],this.timePicker||(this.startDate.startOf("day"),this.endDate.startOf("day")),this.leftCalendar.month.month(this.startDate.month()).year(this.startDate.year()).hour(this.startDate.hour()).minute(this.startDate.minute()),this.rightCalendar.month.month(this.endDate.month()).year(this.endDate.year()).hour(this.endDate.hour()).minute(this.endDate.minute()),this.updateCalendars(),this.updateInputText(),this.container.find(".calendar").hide(),this.hide()}},clickPrev:function(b){var c=a(b.target).parents(".calendar");c.hasClass("left")?this.leftCalendar.month.subtract("month",1):this.rightCalendar.month.subtract("month",1),this.updateCalendars()},clickNext:function(b){var c=a(b.target).parents(".calendar");c.hasClass("left")?this.leftCalendar.month.add("month",1):this.rightCalendar.month.add("month",1),this.updateCalendars()},enterDate:function(b){var c=a(b.target).attr("data-title"),d=c.substr(1,1),e=c.substr(3,1),f=a(b.target).parents(".calendar");f.hasClass("left")?this.container.find("input[name=daterangepicker_start]").val(this.leftCalendar.calendar[d][e].format(this.format)):this.container.find("input[name=daterangepicker_end]").val(this.rightCalendar.calendar[d][e].format(this.format))},clickDate:function(b){var c=a(b.target).attr("data-title"),d=c.substr(1,1),e=c.substr(3,1),f=a(b.target).parents(".calendar");if(f.hasClass("left")){var g=this.leftCalendar.calendar[d][e],h=this.endDate;if("object"==typeof this.dateLimit){var i=moment(g).add(this.dateLimit).startOf("day");h.isAfter(i)&&(h=i)}}else{var g=this.startDate,h=this.rightCalendar.calendar[d][e];if("object"==typeof this.dateLimit){var j=moment(h).subtract(this.dateLimit).startOf("day");g.isBefore(j)&&(g=j)}}f.find("td").removeClass("active"),g.isSame(h)||g.isBefore(h)?(a(b.target).addClass("active"),this.startDate=g,this.endDate=h):g.isAfter(h)&&(a(b.target).addClass("active"),this.startDate=g,this.endDate=moment(g).add("day",1).startOf("day")),this.leftCalendar.month.month(this.startDate.month()).year(this.startDate.year()),this.rightCalendar.month.month(this.endDate.month()).year(this.endDate.year()),this.updateCalendars()},clickApply:function(){this.updateInputText(),this.hide()},clickCancel:function(){this.startDate=this.oldStartDate,this.endDate=this.oldEndDate,this.updateView(),this.updateCalendars(),this.hide()},updateMonthYear:function(b){var c=a(b.target).closest(".calendar").hasClass("left"),d=this.container.find(".calendar.left");c||(d=this.container.find(".calendar.right"));var e=parseInt(d.find(".monthselect").val()),f=d.find(".yearselect").val();c?this.leftCalendar.month.month(e).year(f):this.rightCalendar.month.month(e).year(f),this.updateCalendars()},updateTime:function(b){var c=a(b.target).closest(".calendar").hasClass("left"),d=this.container.find(".calendar.left");c||(d=this.container.find(".calendar.right"));var e=parseInt(d.find(".hourselect").val()),f=parseInt(d.find(".minuteselect").val());if(this.timePicker12Hour){var g=d.find(".ampmselect").val();"PM"==g&&12>e&&(e+=12),"AM"==g&&12==e&&(e=0)}if(c){var h=this.startDate;h.hour(e),h.minute(f),this.startDate=h,this.leftCalendar.month.hour(e).minute(f)}else{var i=this.endDate;i.hour(e),i.minute(f),this.endDate=i,this.rightCalendar.month.hour(e).minute(f)}this.updateCalendars()},updateCalendars:function(){this.leftCalendar.calendar=this.buildCalendar(this.leftCalendar.month.month(),this.leftCalendar.month.year(),this.leftCalendar.month.hour(),this.leftCalendar.month.minute(),"left"),this.rightCalendar.calendar=this.buildCalendar(this.rightCalendar.month.month(),this.rightCalendar.month.year(),this.rightCalendar.month.hour(),this.rightCalendar.month.minute(),"right"),this.container.find(".calendar.left").html(this.renderCalendar(this.leftCalendar.calendar,this.startDate,this.minDate,this.maxDate)),this.container.find(".calendar.right").html(this.renderCalendar(this.rightCalendar.calendar,this.endDate,this.startDate,this.maxDate)),this.container.find(".ranges li").removeClass("active");var a=!0,b=0;for(var c in this.ranges)this.timePicker?this.startDate.isSame(this.ranges[c][0])&&this.endDate.isSame(this.ranges[c][1])&&(a=!1,this.container.find(".ranges li:eq("+b+")").addClass("active")):this.startDate.format("YYYY-MM-DD")==this.ranges[c][0].format("YYYY-MM-DD")&&this.endDate.format("YYYY-MM-DD")==this.ranges[c][1].format("YYYY-MM-DD")&&(a=!1,this.container.find(".ranges li:eq("+b+")").addClass("active")),b++;a&&this.container.find(".ranges li:last").addClass("active")},buildCalendar:function(a,b,c,d){for(var f=moment([b,a,1]),g=moment(f).subtract("month",1).month(),h=moment(f).subtract("month",1).year(),i=moment([h,g]).daysInMonth(),j=f.day(),k=[],l=0;6>l;l++)k[l]=[];var m=i-j+this.locale.firstDay+1;m>i&&(m-=7),j==this.locale.firstDay&&(m=i-6);for(var n=moment([h,g,m,c,d]),l=0,o=0,p=0;42>l;l++,o++,n=moment(n).add("day",1))l>0&&0==o%7&&(o=0,p++),k[p][o]=n;return k},renderDropdowns:function(a,b,c){for(var d=a.month(),e='<select class="monthselect">',f=!1,g=!1,h=0;12>h;h++)(!f||h>=b.month())&&(!g||h<=c.month())&&(e+="<option value='"+h+"'"+(h===d?" selected='selected'":"")+">"+this.locale.monthNames[h]+"</option>");e+="</select>";for(var i=a.year(),j=c&&c.year()||i+5,k=b&&b.year()||i-50,l='<select class="yearselect">',m=k;j>=m;m++)l+='<option value="'+m+'"'+(m===i?' selected="selected"':"")+">"+m+"</option>";return l+="</select>",e+l},renderCalendar:function(b,c,d,e){var f='<div class="calendar-date">';f+='<table class="table-condensed">',f+="<thead>",f+="<tr>",this.showWeekNumbers&&(f+="<th></th>"),f+=!d||d.isBefore(b[1][1])?'<th class="prev available"><i class="fa fa-arrow-left glyphicon glyphfa fa-arrow-left"></i></th>':"<th></th>";var g=this.locale.monthNames[b[1][1].month()]+b[1][1].format(" YYYY");this.showDropdowns&&(g=this.renderDropdowns(b[1][1],d,e)),f+='<th colspan="5" style="width: auto">'+g+"</th>",f+=!e||e.isAfter(b[1][1])?'<th class="next available"><i class="fa fa-arrow-right glyphicon glyphfa fa-arrow-right"></i></th>':"<th></th>",f+="</tr>",f+="<tr>",this.showWeekNumbers&&(f+='<th class="week">'+this.locale.weekLabel+"</th>"),a.each(this.locale.daysOfWeek,function(a,b){f+="<th>"+b+"</th>"}),f+="</tr>",f+="</thead>",f+="<tbody>";for(var h=0;6>h;h++){f+="<tr>",this.showWeekNumbers&&(f+='<td class="week">'+b[h][0].week()+"</td>");for(var i=0;7>i;i++){var j="available ";j+=b[h][i].month()==b[1][1].month()?"":"off",d&&b[h][i].isBefore(d)||e&&b[h][i].isAfter(e)?j=" off disabled ":b[h][i].format("YYYY-MM-DD")==c.format("YYYY-MM-DD")?(j+=" active ",b[h][i].format("YYYY-MM-DD")==this.startDate.format("YYYY-MM-DD")&&(j+=" start-date "),b[h][i].format("YYYY-MM-DD")==this.endDate.format("YYYY-MM-DD")&&(j+=" end-date ")):b[h][i]>=this.startDate&&b[h][i]<=this.endDate&&(j+=" in-range ",b[h][i].isSame(this.startDate)&&(j+=" start-date "),b[h][i].isSame(this.endDate)&&(j+=" end-date "));var k="r"+h+"c"+i;f+='<td class="'+j.replace(/\s+/g," ").replace(/^\s?(.*?)\s?$/,"$1")+'" data-title="'+k+'">'+b[h][i].date()+"</td>"}f+="</tr>"}if(f+="</tbody>",f+="</table>",f+="</div>",this.timePicker){f+='<div class="calendar-time">',f+='<select class="hourselect">';var l=0,m=23,n=c.hour();this.timePicker12Hour&&(l=1,m=12,n>=12&&(n-=12),0==n&&(n=12));for(var o=l;m>=o;o++)f+=o==n?'<option value="'+o+'" selected="selected">'+o+"</option>":'<option value="'+o+'">'+o+"</option>";f+="</select> : ",f+='<select class="minuteselect">';for(var o=0;60>o;o+=this.timePickerIncrement){var p=o;10>p&&(p="0"+p),f+=o==c.minute()?'<option value="'+o+'" selected="selected">'+p+"</option>":'<option value="'+o+'">'+p+"</option>"}f+="</select> ",this.timePicker12Hour&&(f+='<select class="ampmselect">',f+=c.hour()>=12?'<option value="AM">AM</option><option value="PM" selected="selected">PM</option>':'<option value="AM" selected="selected">AM</option><option value="PM">PM</option>',f+="</select>"),f+="</div>"}return f}},a.fn.daterangepicker=function(c,d){return this.each(function(){var e=a(this);e.data("daterangepicker")||e.data("daterangepicker",new b(e,c,d))}),this}}(window.jQuery);