if (typeof clickWidgetName==='undefined') {var clickWidgetName = 'rbag-widget-view';}
if (typeof viewPageName==='undefined') {var viewPageName = 'rbag-page-view';}
if (typeof redirectPageName==='undefined') {var redirectPageName = 'rbag-page-redirect';}
if (typeof rbagLocalStorage==='undefined') {var rbagLocalStorage = "nun";}

function rbag_localStorageValue(elementName, action="check") {
    let result = false;
    if (rbagLocalStorage==="nun") {
        rbagLocalStorage = window.localStorage;
    }
    if (rbagLocalStorage&&rbagLocalStorage!=="nun") {
        let elementValue = rbagLocalStorage.getItem(elementName);

        switch (action) {
            case "check":
                if (!elementValue) {
                    result = true;
                }
                break;
            case "update":
                if (!elementValue) {
                    rbagLocalStorage.setItem(elementName, 'marked');
                }
                break;
            case "clear":
                rbagLocalStorage.removeItem(elementName);
                break;
        }
    }
    return result;
}
/*
rbag_localStorageValue(clickWidgetName, "clear");
rbag_localStorageValue(viewPageName, "clear");
rbag_localStorageValue(redirectPageName, "clear");
/**/

function rbag_formData(dataName) {
    let data = {};
    data.name = dataName;
    data = JSON.stringify(data);

    return data;
}

function rbag_sendAjaxStat(dataToSend, elementName) {
    let xhttp = new XMLHttpRequest(),
        sendData = 'type=saveStat&data='+dataToSend,
        url = rbag_ajaxurl+'?action=saveAjaxStat';

    xhttp.onload = function(redata) {
        console.log('test ajax stat loaded');
        if (xhttp.responseText&&xhttp.responseText==='saved') {
            console.log('updtd');
            rbag_localStorageValue(elementName, "update");
        }
        rbagRedirectAction(elementName);
    }
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(sendData);
}

function rbagElementsAction(elementName) {
    let checkResult,
        dataToSend;

    console.log('here 12');
    if (!rbag_ajaxurl) {
        return false;
    }

    checkResult = rbag_localStorageValue(elementName, "check");
    if (checkResult===false) {
        rbagRedirectAction(elementName);
        return false;
    }

    dataToSend = rbag_formData(elementName);
    if (dataToSend) {
        rbag_sendAjaxStat(dataToSend, elementName);
    }

    return true;
}

function rbagWidgetButtonClicked() {
    rbagElementsAction(clickWidgetName);
}
function rbagPageButtonClicked() {
    rbagElementsAction(redirectPageName);
}

function rbagRedirectAction(elementName) {
    let widgetButon,
        urlToRedirect;

    switch (elementName) {
        case clickWidgetName:
            widgetButon = document.querySelector('.rbag-widget-button1');
            if (widgetButon) {
                urlToRedirect = widgetButon.dataset.href;
                if (urlToRedirect) {
                    window.location.href = urlToRedirect;
                }
            }
            break;
        case redirectPageName:
            widgetButon = document.querySelector('.rbag-agency-redirect');
            if (widgetButon) {
                urlToRedirect = widgetButon.dataset.href;
                if (urlToRedirect) {
                    window.location.href = urlToRedirect;
                }
            }
            break;
    }

    return false;
}