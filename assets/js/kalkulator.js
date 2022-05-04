let totalEmisi = 0;

const inputMotor = document.querySelector("#input-motor");
const inputMobil = document.querySelector("#input-mobil");
const inputKereta = document.querySelector("#input-kereta");
const inputBus = document.querySelector("#input-bus");
const inputAc = document.querySelector("#input-ac");
const inputKomputer = document.querySelector("#input-komputer");
const inputKulkas = document.querySelector("#input-kulkas");
const inputSetrika = document.querySelector("#input-setrika");
const inputMesinCuci = document.querySelector("#input-mesin-cuci");
const inputHairDryer = document.querySelector("#input-hair-dryer");
const inputMicrowave = document.querySelector("#input-microwave");
const inputPrinter = document.querySelector("#input-printer");

const arrInput = [inputMotor, inputMobil, inputKereta, inputBus, inputAc, inputKomputer, inputKulkas, inputSetrika, inputMesinCuci, inputHairDryer, inputMicrowave, inputPrinter];

arrInput.forEach((input) => {
    input.addEventListener('keyup', () => {
        updateInput();
        updateHasilEmisi();
    })
})

const updateInput = () => {
    totalEmisi = 0;
    totalEmisi += 852 * checkNaN(inputMotor);
    totalEmisi += 2412 * checkNaN(inputMobil);
    totalEmisi += 270 * checkNaN(inputKereta);
    totalEmisi += 394 * checkNaN(inputBus);
    totalEmisi += 171 * checkNaN(inputAc);
    totalEmisi += 921 * checkNaN(inputKomputer);
    totalEmisi += 2672 * checkNaN(inputKulkas);
    totalEmisi += 17061 * checkNaN(inputSetrika);
    totalEmisi += 4095 * checkNaN(inputMesinCuci);
    totalEmisi += 5100 * checkNaN(inputHairDryer);
    totalEmisi += 85 * checkNaN(inputMicrowave);
    totalEmisi += 2040 * checkNaN(inputPrinter);
}

const checkNaN = (input) => {
    return (input.value) ? parseInt(input.value) : 0;
}

const totalEmisiText = document.querySelector("#total-emisi");
const convertBatuBara = document.querySelector("#convert-batubara");
const convertKayu = document.querySelector("#convert-kayu");
const convertBensin = document.querySelector("#convert-bensin");
const convertLpg = document.querySelector("#convert-lpg");
const convertSolar = document.querySelector("#convert-solar");

const updateHasilEmisi = () => {
    totalEmisiText.innerHTML = totalEmisi;

    convertBatuBara.innerHTML = Math.round(totalEmisi / 23060 * 100) / 100;
    convertKayu.innerHTML = Math.round(totalEmisi / 14666 * 100) / 100;
    convertBensin.innerHTML = Math.round(totalEmisi / 33025 * 100) / 100;
    convertLpg.innerHTML = Math.round(totalEmisi / 24121 * 100) / 100;
    convertSolar.innerHTML = Math.round(totalEmisi / 36645 * 100) / 100;
}