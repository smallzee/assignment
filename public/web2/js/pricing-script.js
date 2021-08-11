//pricing style toggle switcher
var filMonthly = document.getElementById("fil-monthly");
var filYearly = document.getElementById("fil-Yearly");
var switcherInput = document.getElementById("switcher");
var toggleSwitcher = document.getElementById("toggle-switcher");
var monthlyBtn = document.getElementById("monthly");
var yearlyBtn = document.getElementById("yearly");

filMonthly.addEventListener("click", function(){
    switcherInput.checked = false;
    filMonthly.classList.add("toggler--is-active");
    filYearly.classList.remove("toggler-is-active");
    toggleSwitcher.classList.remove("toggle-bg-active");
    monthlyBtn.classList.remove("package-hide");
    yearlyBtn.classList.add("package-hide");
});

filYearly.addEventListener("click", function(){
    switcherInput.checked = true;
    filYearly.classList.add("toggler-is-active");
    filMonthly.classList.remove("toggler-is-active");
    toggleSwitcher.classList.add("toggle-bg-active");
    monthlyBtn.classList.add("package-hide");
    yearlyBtn.classList.remove("package-hide");
});

switcherInput.addEventListener("click", function(){
    filYearly.classList.toggle("toggler-is-active");
    filMonthly.classList.toggle("toggler-is-active");
    toggleSwitcher.classList.toggle("toggle-bg-active");
    monthlyBtn.classList.toggle("package-hide");
    yearlyBtn.classList.toggle("package-hide");
});