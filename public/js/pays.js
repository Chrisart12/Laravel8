document.addEventListener('DOMContentLoaded', () => {

    const fundingMethodElt = document.getElementById("pays");
    const fundingCheckboxesElts = document.querySelector(".funding_checkboxes")
    var expanded = false;

        if(fundingMethodElt) {
            fundingMethodElt.addEventListener('click', function() {
                if (!expanded) {
                    fundingCheckboxesElts.style.display = "block";
                        expanded = true;
                    } else {
                        fundingCheckboxesElts.style.display = "none";
                        expanded = false;
                    }
            })
        }

})
