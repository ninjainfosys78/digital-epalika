class dateHelper {
    currentBsDate() {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.ConvertDateFormat(
            // eslint-disable-next-line no-undef
            NepaliFunctions.GetCurrentBsDate(),
            "YYYY-MM-DD"
        );
    }

    currentAdDate() {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.ConvertDateFormat(
            // eslint-disable-next-line no-undef
            NepaliFunctions.GetCurrentAdDate(),
            "YYYY-MM-DD"
        );
    }

    adToBs(ad_date){
        // eslint-disable-next-line no-undef
        const adDateObj=(NepaliFunctions.ParseDate(ad_date)).parsedDate
        // eslint-disable-next-line no-undef
        const bsDateObj=NepaliFunctions.AD2BS({year: adDateObj.year, month: adDateObj.month, day: adDateObj.day})

        // eslint-disable-next-line no-undef
        return NepaliFunctions.ConvertDateFormat({year: bsDateObj.year, month: bsDateObj.month, day: bsDateObj.day}, "YYYY-MM-DD")
    }

    getDay() {
        let N = new Date(2023, 4 - 1, 26)
        return N.getDay()
    }

    toUniCode(num) {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.ConvertToUnicode(num)
    }

    currentBsYear() {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.GetCurrentBsYear();
    }

    currentAdYear() {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.GetCurrentAdYear();
    }

    currentBsMonth() {
        // eslint-disable-next-line no-undef
        const month = NepaliFunctions.GetCurrentBsMonth()
        return month < 10 ? '0' + month : month;
    }

    bsMonths() {
        // eslint-disable-next-line no-undef
        return NepaliFunctions.GetBsMonths()
    }

    days() {
        return [
            {name: "Sunday", nep_day: "आइत ", day: "1"},
            {name: "Monday", nep_day: "सोम", day: "2"},
            {name: "Tuesday", nep_day: "मंगल", day: "3"},
            {name: "Wednesday", nep_day: "बुध", day: "4"},
            {name: "Thursday", nep_day: "बिहि", day: "5"},
            {name: "Friday", nep_day: "शुक्र", day: "6"},
            {name: "Saturday", nep_day: "शनि", day: "7"},
        ]
    }
}


export default new dateHelper();
