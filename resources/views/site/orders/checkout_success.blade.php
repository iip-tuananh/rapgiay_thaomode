<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="flexbox">
<head>
    <link rel="shortcut icon" href="{{ $config->favicon->path }}" type="image/png" />
    <title>
        {{$config->web_title}} - Đơn hàng#{{$order->code}}
    </title>
    <meta name="description" content="{{$config->web_title}} - Đơn hàng#{{$order->code}}" />
    <style>
        .btn {
        display: inline-block;
        border-radius: 4px;
        font-weight: 500;
        padding: 1.4em 1.7em;
        box-sizing: border-box;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        position: relative;
        background: #338dbc;
        color: white;
        }
        .fieldset .field .field-input-wrapper .field-input {
        box-shadow: 0 0 0 1px #d9d9d9;
        transition: all 0.2s ease-out;
        background-color: white ;
        color: #333333;
        border-radius: 4px;
        display: block;
        box-sizing: border-box;
        width: 100%;
        padding: 0.94em 2.8em 0.94em 0.8em;
        word-break: normal;
        }
        body {
        color: #737373;
        background: white !important;
        font-size: 14px;
        font-family:Helvetica Neue, sans-serif;
        line-height: 1.3em;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
        -webkit-font-smoothing: subpixel-antialiased;
        overflow-x: hidden;
        }
        .fieldset .field .field-input-wrapper .field-input:focus {
        box-shadow: 0 0 0 2px #338dbc;
        outline: none;
        }
        .radio-wrapper .radio-input .input-radio:checked,
        .checkbox-wrapper .checkbox-input .input-checkbox:checked {
        border: none;
        box-shadow: 0 0 0 10px #338dbc inset;
        }
        .fieldset .field.field-error .field-input-wrapper .field-input {
        box-shadow: 0 0 0 2px #ff6d6d;
        outline: none;
        }
        html, body {
        margin: 0;
        width: 100%;
        height: 100%; /* == 2 => 1 page, == 1 => 2 page*/
        }
        a {
        text-decoration: none;
        color:  #338dbc;
        transition: color 0.2s ease-in-out;
        display: inline-block;
        }
        .banner {
        padding: 1.5em 0;
        display: none;;
        }
        .alert {
        padding: 16px;
        border-radius: 5px;
        display: -webkit-flex;
        display: flex;
        align-items: center;
        }
        .alert-danger svg {
        width: 20px;
        margin-right: 10px;
        }
        .alert-danger span {
        max-width: calc(100% - 30px);
        }
        .alert-danger * {
        flex: 0 0 auto;
        }
        .alert-danger {
        color: #721c24;
        background-color: #ffebeb;
        border-color: #ffebeb;
        line-height: 20px;
        }
        @-webkit-keyframes rotate {
        0% {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        }
        100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
        }
        }
        @keyframes rotate {
        0% {
        -webkit-transform: rotate(0);
        transform: rotate(0);
        }
        100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
        }
        }
        a:focus {
        outline: none;
        }
        a:hover {
        /* color: #2b78a0; */
        filter: brightness(1.2);
        }
        ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
        }
        h1, h2, h3, h4, h5, h6 {
        font-weight: normal;
        margin: 0;
        line-height: 1em;
        }
        h2 {
        font-size: 1.28571em;
        }
        h3 {
        font-size: 1em;
        font-weight: 500;
        margin-bottom: 0.75em;
        }
        h3:not(:first-child) {
        margin-top: 1.5em;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font-size: 1em;
        }
        td, th {
        padding: 0;
        padding-left: 1em;
        }
        td:first-child, th:first-child {
        padding-left: 0;
        text-align: left;
        }
        td:last-child, th:last-child {
        text-align: right;
        }
        img {
        border: 0;
        max-width: 100%;
        }
        p {
        margin: 0;
        line-height: 1.5em;
        }
        button, input, optgroup, select, textarea {
        color: inherit;
        font: inherit;
        margin: 0;
        padding: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: inherit;
        border: none;
        background: transparent;
        line-height: normal;
        }
        button:focus, input:focus {
        outline: none;
        }
        button, input[type="button"], input[type="reset"], input[type="submit"] {
        -webkit-appearance: button;
        cursor: pointer;
        }
        select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
        }
        .radio-wrapper,
        .checkbox-wrapper {
        display: table;
        box-sizing: border-box;
        width: 100%;
        zoom: 1;
        }
        .radio-wrapper:after, .radio-wrapper:before,
        .checkbox-wrapper:after, .checkbox-wrapper:before {
        content: "";
        display: table;
        }
        .radio-wrapper .radio-input,
        .checkbox-wrapper .checkbox-input {
        display: table-cell;
        padding-right: 0.75em;
        white-space: nowrap;
        }
        .radio-wrapper .payment-method-checkbox {
        display: flex;
        align-self: center;
        }
        .radio-wrapper .radio-input .input-radio,
        .checkbox-wrapper .checkbox-input .input-checkbox {
        width: 18px;
        height: 18px;
        box-shadow: 0 0 0 0 #338dbc inset;
        transition: all 0.2s ease-in-out;
        position: relative;
        cursor: pointer;
        vertical-align: -4px;
        outline: 0;
        border: solid 1px #d9d9d9;
        }
        .radio-wrapper .radio-input .input-radio:hover,
        .checkbox-wrapper .checkbox-input .input-checkbox:hover {
        border-color: #cccccc;
        }
        .radio-wrapper .radio-input .input-radio {
        border-radius: 50%;
        }
        .radio-wrapper .radio-content-input {
        display: flex;
        align-items: center;
        }
        .radio-content-input .content-wrapper {
        display: grid
        }
        .radio-wrapper .radio-content-input .main-img {
        margin-right: 10px;
        display: flex;
        align-self: center;
        width: 40px;
        height: 40px;
        }
        .radio-wrapper .radio-content-input-no-icon {
        margin: 0.8em 0.8em 0.8em 0;
        }
        .radio-wrapper .radio-content-input .child-img {
        max-height: 30px
        }
        .radio-wrapper .radio-content-input .quick-tagline {
        color: #338dbc;
        display:flex;
        align-items: center;
        margin-top: 2px;
        }
        .radio-wrapper .radio-content-input .quick-tagline svg{
        fill: #338dbc;
        margin-left: 10px;
        }
        .radio-wrapper .radio-input .input-radio:checked:focus,
        .checkbox-wrapper .checkbox-input .input-checkbox:checked:focus {
        border-color: #286f94;
        }
        .radio-wrapper .radio-input .input-radio:checked:after,
        .checkbox-wrapper .checkbox-input .input-checkbox:checked:after {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 100 ")";
        filter: alpha(opacity=100);
        }
        .radio-wrapper .radio-input .input-radio:after,
        .checkbox-wrapper .checkbox-input .input-checkbox:after {
        content: "";
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: scale(0.2);
        transform: scale(0.2);
        transition: all 0.2s ease-in-out 0.1s;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 0 ")";
        filter: alpha(opacity=0);
        }
        .radio-wrapper .radio-input .input-radio:after {
        width: 4px;
        height: 4px;
        margin-left: -2px;
        margin-top: -2px;
        background-color: #fff;
        border-radius: 50%;
        }
        .radio-wrapper .radio-label,
        .checkbox-wrapper .checkbox-label {
        display: flex !important;
        cursor: pointer !important;
        align-items: center ;
        padding: 1.3em ;
        width: auto ;
        }
        .radio-wrapper .radio-label-payment-card,
        .checkbox-wrapper .checkbox-label {
        display: flex !important;
        cursor: pointer !important;
        align-items: center ;
        padding: 0 0.5em ;
        width: auto ;
        }
        .radio-wrapper .two-page,
        .checkbox-wrapper .checkbox-label {
        display: flex ;
        cursor: pointer ;
        align-items: center ;
        padding: 1.3em ;
        width: auto ;
        }
        .radio-wrapper .radio-label .radio-label-primary,
        .checkbox-wrapper .checkbox-label .checkbox-label-primary {
        display: table-cell;
        width: 100%;
        }
        .radio-wrapper .radio-accessory,
        .checkbox-wrapper .checkbox-accessory {
        display: table-cell;
        padding-left: 0.75em;
        white-space: nowrap;
        }
        .radio-wrapper.no-box,
        .checkbox-wrapper.no-box {
        display: block;
        }
        .radio-wrapper.no-box .radio-input,
        .checkbox-wrapper.no-box .checkbox-input {
        display: inline-block;
        }
        .radio-wrapper.no-box .radio-label,
        .checkbox-wrapper.no-box .checkbox-label {
        display: inline-block;
        width: inherit;
        }
        ::selection {
        background: #338dbc;
        color: white;
        }
        .btn:not(.btn-disabled):hover {
        /* background: #286f94; */
        color: white;
        filter: brightness(1.2);
        }
        .btn-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -10px;
        margin-left: -10px;
        /*transition: opacity 0.3s ease-in-out;*/
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 0 ")";
        filter: alpha(opacity=0);
        }
        .btn-loading {
        pointer-events: none;
        cursor: default;
        }
        .btn-loading .btn-content {
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 0 ")";
        filter: alpha(opacity=0);
        }
        .btn-loading .btn-spinner {
        -webkit-animation: rotate 0.5s linear infinite;
        animation: rotate 0.5s linear infinite;
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 100 ")";
        filter: alpha(opacity=100);
        }
        #div_location_country_not_vietnam{ display: none; }
        div#section-shipping-rate,#section-payment-method {
        position: relative;
        }
        .icon {
        background-position: center center;
        background-repeat: no-repeat;
        display: inline-block;
        }
        .icon.icon-button-spinner {
        width: 20px;
        height: 20px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHBhdGggZD0iTTIwIDEwYzAgNS41MjMtNC40NzcgMTAtMTAgMTBTMCAxNS41MjMgMCAxMCA0LjQ3NyAwIDEwIDB2MmMtNC40MTggMC04IDMuNTgyLTggOHMzLjU4MiA4IDggOCA4LTMuNTgyIDgtOGgyeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg=='),none;
        }
        .icon.icon-clear {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMiAtNCAxNiAxNiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAyIC00IDE2IDE2Ij48cGF0aCBvcGFjaXR5PSIuMiIgZD0iTTEwLTRjLTQuNCAwLTggMy42LTggOHMzLjYgOCA4IDggOC0zLjYgOC04LTMuNi04LTgtOHptMy43IDEwLjdsLTEgMS0yLjctMi42LTIuNyAyLjYtMS0xIDIuNi0yLjctMi42LTIuNyAxLTEgMi43IDIuNiAyLjctMi42IDEgMS0yLjYgMi43IDIuNiAyLjd6Ii8+PC9zdmc+'),none;
        }
        .icon.icon-os-question {
        width: 18px;
        height: 18px;
        margin-right: 0.5em;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxOCIgdmlld0JveD0iMCAwIDE4IDE4Ij48cGF0aCBkPSJNOSAxOGM0Ljk3IDAgOS00LjAzIDktOXMtNC4wMy05LTktOS05IDQuMDMtOSA5IDQuMDMgOSA5IDl6TTUuODUgNy4xNjJoMS41NDZjLjA1My0uODAzLjYtMS4zMTcgMS40NS0xLjMxNy44MjggMCAxLjM4LjQ5NCAxLjM4IDEuMTggMCAuNjUtLjI3NSAxLTEuMDkyIDEuNDkzLS45MDguNTM0LTEuMjkgMS4xMjYtMS4yMyAyLjExNGwuMDA2LjQ0OGgxLjUyN3YtLjM3NmMwLS42NS4yNDQtLjk4NyAxLjEwNi0xLjQ5NC44OTYtLjUzNCAxLjM5Ni0xLjIzOCAxLjM5Ni0yLjI0NiAwLTEuNDU1LTEuMjA3LTIuNDk1LTMuMDEtMi40OTUtMS45NTUgMC0zLjAzIDEuMTMtMy4wOCAyLjY5em0yLjg5NiA3LjA1OGMuNjcyIDAgMS4wOTMtLjQxNCAxLjA5My0xLjA0NiAwLS42NC0uNDIzLTEuMDU0LTEuMDk1LTEuMDU0LS42NiAwLTEuMDkzLjQxNS0xLjA5MyAxLjA1NCAwIC42MzIuNDM0IDEuMDQ2IDEuMDkzIDEuMDQ2eiIgZmlsbD0iI0I1QjVCNSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+'),none;
        }
        .icon.icon-closed-box {
        width: 68px;
        height: 54px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2OCIgaGVpZ2h0PSI1NCIgdmlld0JveD0iMjQuMSAtMTcgNjggNTQiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMjQuMSAtMTcgNjggNTQiPjxwYXRoIHN0cm9rZT0iI0IyQjJCMiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGZpbGw9Im5vbmUiIGQ9Ik0yNS4xLTVoNjZNMzIuMSAyOGgxNk0zMi4xIDIzaDEyIi8+PHBhdGggc3Ryb2tlPSIjQjJCMkIyIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgZD0iTTI1LjEtNS40bDYuNy0xMC42aDUyLjlsNi40IDEwLjZ2MzguNmMwIDEuNi0xLjIgMi44LTIuOCAyLjhoLTYwLjRjLTEuNiAwLTIuOC0xLjItMi44LTIuOHYtMzguNnpNNTguMS0xNnYxMSIgZmlsbD0ibm9uZSIvPjwvc3ZnPg=='),none;
        }
        .icon.icon-closed-box.has-error {
        width: 68px;
        height: 54px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2OCIgaGVpZ2h0PSI1NCIgdmlld0JveD0iMjQuMSAtMTcgNjggNTQiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMjQuMSAtMTcgNjggNTQiPjxwYXRoIHN0cm9rZT0iI2ZmNmQ2ZCIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGZpbGw9Im5vbmUiIGQ9Ik0yNS4xLTVoNjZNMzIuMSAyOGgxNk0zMi4xIDIzaDEyIi8+PHBhdGggc3Ryb2tlPSIjZmY2ZDZkIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgZD0iTTI1LjEtNS40bDYuNy0xMC42aDUyLjlsNi40IDEwLjZ2MzguNmMwIDEuNi0xLjIgMi44LTIuOCAyLjhoLTYwLjRjLTEuNiAwLTIuOC0xLjItMi44LTIuOHYtMzguNnpNNTguMS0xNnYxMSIgZmlsbD0ibm9uZSIvPjwvc3ZnPg=='),none;
        }
        .flexbox {
        }
        .flexbox body, .flexbox .content, .flexbox .content .wrap, .flexbox .main {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-flex: 1 0 auto;
        -ms-flex: 1 0 auto;
        flex: 1 0 auto;
        }
        .flexbox .main-content {
        -webkit-flex: 1 0 auto;
        -ms-flex: 1 0 auto;
        flex: 1 0 auto;
        }
        .step-footer {
        z-index: 2;
        position: relative;
        margin-top: 1em;
        zoom: 1;
        }
        .step-footer:after, .step-footer:before {
        content: "";
        display: table;
        }
        .step-footer:after {
        clear: both;
        }
        .step-footer .step-footer-previous-link {
        cursor: pointer;
        display: block;
        }
        .step-footer .step-footer-previous-link .previous-link-icon {
        fill: #338dbc;
        transition: all 0.2s cubic-bezier(0.3, 0, 0, 1);
        margin-right: 0.25em;
        }
        .step-footer .step-footer-previous-link:hover .previous-link-icon {
        fill: #2b78a0;
        -webkit-transform: translateX(-5px);
        transform: translateX(-5px);
        }
        .step-footer .step-footer-info {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        }
        .content {
        overflow-x: hidden;
        }
        .content.content-second {
        display: none;
        }
        .section {
        position: relative;
        padding-top: 2em;
        }
        .section.thank-you-checkout-info {
        padding-top: 0.5em;
        }
        .section:first-child {
        padding-top: 0;
        }
        .section .section-header {
        position: relative;
        }
        .section .section-content {
        zoom: 1;
        margin-bottom: 2em;
        }
        .section .section-content .section-content-text {
        margin-bottom: 0.75em;
        }
        .section .section-content.no-mb, .section .section-content:last-child {
        margin-bottom: inherit;
        }
        .section .section-content:after, .section .section-content:before {
        content: "";
        display: table;
        }
        .section .section-content .content-box {
        box-shadow: 0 0 0 1px #d9d9d9;
        border-radius: 4px;
        background: #fff;
        color: #737373;
        margin-top: 1em;
        }
        .section .section-content .content-box.has-error {
        box-shadow: 0 0 0 2px #ff6d6d;
        color: #ff6d6d;
        }
        .section .section-content .content-box.no-border {
        box-shadow: none;
        }
        .section .section-content .content-box:first-child {
        margin-top: 0;
        }
        .section .section-content .content-box .content-box-row {
        display: table;
        box-sizing: border-box;
        width: 100%;
        border-top: 1px solid #d9d9d9;
        zoom: 1;
        }
        .section .section-content .content-box .content-box-row.content-box-row-padding {
        padding: 0.8em 0.6em;
        }
        .section .section-content .content-box .content-box-row:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top: none;
        }
        .section .section-content .content-box .content-box-row:last-child {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        }
        .section .section-content .content-box .content-box-row:after,
        .section .section-content .content-box .content-box-row:before {
        content: "";
        display: table;
        }
        .section .section-content .content-box .content-box-row.content-box-row-secondary {
        background-color: #fafafa;
        }
        .section .section-content .content-box .content-box-row.content-box-row-no-border {
        padding-bottom: 0;
        }
        .section .section-content .content-box .content-box-row.content-box-row-no-border + .content-box-row {
        border-top: none !important;
        }
        .section .section-content .content-box .content-box-row-payment-card {
        display: table;
        box-sizing: border-box;
        width: 100%;
        zoom: 1;
        }
        .section .section-content .content-box .content-box-row-payment-card.content-box-row-padding {
        padding: 0.8em 0.6em;
        }
        .section .section-content .content-box .content-box-row-payment-card:first-child {
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top: 1px solid #d9d9d9;
        }
        .section .section-content .content-box .content-box-row-payment-card:last-child {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        }
        .section .section-content .content-box .content-box-row-payment-card:after,
        .section .section-content .content-box .content-box-row-payment-card:before {
        content: "";
        display: table;
        }
        .section .section-content .content-box .content-box-row-payment-card.content-box-row-secondary {
        background-color: #fafafa;
        }
        .section .section-content .content-box .content-box-row-payment-card.content-box-row-no-border {
        padding-bottom: 0;
        }
        .section .section-content .content-box .content-box-row-payment-card.content-box-row-no-border + .content-box-row {
        border-top: none !important;
        }
        .section .section-content .content-box .content-box-emphasis {
        font-weight: 500;
        color: #4d4d4d;
        }
        .section .section-content .content-box h3 {
        color: #4d4d4d;
        }
        .section .section-content .content-box h2 {
        color: #333333;
        }
        .section .section-content .content-box h2:only-child {
        margin: 0;
        }
        .section .section-title {
        color: #333333;
        }
        .payment-later-table, .payment-later-table > table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        box-shadow: 0px 0px 5px rgb(10 31 68 / 21%);
        border-radius: 9px;
        background-color: #FFFFFF;
        }
        .paylater--text{
        color:#ACA9A9;
        }
        .paylater--h4{
        padding-top: 1em;
        }
        .border-bot-1px {
        border-bottom: 1px solid #d9d9d9;
        }
        .font-weight-bold {
        font-weight:  bold;
        }
        .payment-card {
        padding: 0 .8em 0 1.8em;
        white-space: normal;
        }
        .payment-card--text{
        color:#ACA9A9;
        }
        .payment-card--h4{
        text-align: left;
        padding-top: 1em;
        }
        .payment-card--title{
        text-align: left;
        margin: 1em;
        }
        .payment-later-table--loading{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        box-shadow: 0px 0px 5px rgb(10 31 68 / 21%);
        border-radius: 9px;
        background-color: #FFFFFF;
        display: none;
        }
        .payment-later-table--loading.show {
        display: block;
        }
        .payment-later-table > table th{
        text-align: center;
        padding: 16px;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        color: #338DBC;
        }
        .payment-later-table > table th:first-child{
        text-align: left;
        border-top-left-radius: 9px;
        border: 1px;
        }
        .payment-later-table > table th:last-child{
        text-align: right;
        border-top-right-radius: 9px;
        border: 1px;
        }
        .payment-later-table > table td{
        text-align: center;
        padding: 16px;
        font-weight: 500;
        }
        .payment-later-table > table td:first-child{
        text-align: left;
        }
        .payment-later-table > table td:last-child{
        text-align: right;
        padding: 16px;
        }
        .payment-later-table > table tr:nth-child(odd){
        background-color: #D9D9D9
        ;
        }
        .fieldset {
        margin: -0.45em;
        zoom: 1;
        }
        .fieldset:after, .fieldset:before {
        content: "";
        display: table;
        }
        .fieldset:after {
        clear: both;
        }
        .fieldset .field {
        width: 100%;
        float: left;
        padding: 0.45em;
        box-sizing: border-box;
        }
        .fieldset .field .field-input-btn-wrapper {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        }
        .fieldset .field .field-input-btn-wrapper .field-input-btn {
        width: auto;
        margin-left: 0.9em;
        white-space: nowrap;
        padding-top: 0;
        padding-bottom: 0;
        }
        .fieldset .field .field-input-btn-wrapper .field-input-wrapper {
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        }
        .fieldset .field .field-input-wrapper {
        position: relative;
        }
        .fieldset .field .field-input-wrapper .field-label {
        font-size: 0.85714em;
        font-weight: normal;
        position: absolute;
        top: 0;
        width: 100%;
        padding: 0 0.93333em;
        z-index: 1;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-transform: translateY(3px);
        transform: translateY(3px);
        pointer-events: none;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        box-sizing: border-box;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 0 ")";
        filter: alpha(opacity=0);
        color: #999999;
        transition: all 0.2s ease-out;
        margin: 0.5em 0;
        margin-top: 0.3em;
        display: block;
        }
        .fieldset .field .field-input-wrapper .field-description {
        display: block;
        margin-left: 25px;
        margin-top: 2px;
        }
        .fieldset .field .field-input-wrapper.field-input-wrapper-select {
        }
        .fieldset .field .field-input-wrapper.field-input-wrapper-select::before {
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMSIgaGVpZ2h0PSIxOSIgdmlld0JveD0iMCAwIDIxIDE5Ij48dGl0bGU+QXJ0Ym9hcmQgMTwvdGl0bGU+PGRlc2M+Q3JlYXRlZCB3aXRoIFNrZXRjaC48L2Rlc2M+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48ZyBmaWxsPSIjMDAwIj48Zz48cGF0aCBkPSJNMCAwaDF2MTlIMFYweiIgaWQ9IlNoYXBlIiBmaWxsLW9wYWNpdHk9Ii4xNSIvPjxwYXRoIGQ9Ik0xMSA4aDEwbC01IDUtNS01eiIgZmlsbC1vcGFjaXR5PSIuNSIvPjwvZz48L2c+PC9nPjwvc3ZnPg=='),none;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 50px;
        background-position: center center;
        background-repeat: no-repeat;
        pointer-events: none;
        }
        .fieldset .field .field-message {
        font-size: 0.85714em;
        }
        .fieldset .field .field-message.field-message-error {
        margin: 0;
        display: none;
        margin: 0.75em 0 0.25em;
        transition: all 0.3s ease-out;
        line-height: 1.3em;
        color: #ff6d6d
        }
        .fieldset .field.field-active {
        }
        .fieldset .field.field-active .field-input-wrapper .field-label {
        color: #737373;
        }
        .fieldset .field.field-show-floating-label {
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-label {
        -webkit-transform: none;
        transform: none;
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 100 ")";
        filter: alpha(opacity=100);
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-input {
        padding-top: 1.5em;
        padding-bottom: 0.38em;
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-input::-webkit-input-placeholder {
        color: transparent;
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-input::-moz-placeholder {
        color: transparent;
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-input::-moz-placeholder {
        color: transparent;
        }
        .fieldset .field.field-show-floating-label .field-input-wrapper .field-input::-ms-input-placeholder {
        color: transparent;
        }
        .fieldset .field.field-error {
        }
        .fieldset .field.field-error .field-input-wrapper {
        }
        .fieldset .field.field-error .field-message.field-message-error {
        display: block;
        }
        .wrap {
        margin: 0 auto;
        max-width: 40em;
        zoom: 1;
        }
        .wrap:after {
        clear: both;
        }
        .wrap:after, .wrap:before {
        content: "";
        display: table;
        }
        .sidebar {
        position: relative;
        color: #717171;
        }
        .sidebar h2 {
        color: #323232;
        }
        .sidebar:after {
        content: "";
        display: block;
        width: 300%;
        position: absolute;
        top: 0;
        left: -100%;
        bottom: 0;
        background: #fafafa;
        z-index: -1;
        box-shadow: 0 -1px 0 #e1e1e1 inset;
        }
        .sidebar .sidebar-content {
        }
        .sidebar .sidebar-content .order-summary {
        }
        .sidebar .sidebar-content .order-summary .order-summary-sections {
        }
        .sidebar .sidebar-content .order-summary .order-summary-sections .order-summary-section {
        border-top: 1px solid;
        padding-top: 1.5em;
        padding-bottom: 1em;
        border-color: #e1e1e1;
        }
        .sidebar .sidebar-content .order-summary .order-summary-sections .order-summary-section:first-child {
        border-top: none;
        }
        .sidebar .sidebar-content .order-summary .order-summary-emphasis {
        font-weight: 500;
        color: #4b4b4b;
        }
        .sidebar .sidebar-content .order-summary .order-summary-small-text {
        font-size: 0.85714em;
        color: #969696;
        }
        .sidebar .sidebar-content .order-summary .product {
        }
        .sidebar .sidebar-content .order-summary .product:first-child td {
        padding-top: 0;
        }
        .sidebar .sidebar-content .order-summary .product td {
        padding-top: 1em;
        }
        .sidebar .sidebar-content .order-summary .product .product-image {
        }
        .sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail {
        width: 4.6em;
        height: 4.6em;
        border-radius: 8px;
        background: #fff;
        position: relative;
        }
        .sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail .product-thumbnail-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        }
        .sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail .product-thumbnail-wrapper .product-thumbnail-image {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        max-width: 100%;
        max-height: 100%;
        margin: auto;
        }
        .sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail .product-thumbnail-quantity {
        font-size: 0.85714em;
        font-weight: 500;
        white-space: nowrap;
        padding: 0.15em 0.65em;
        border-radius: 2em;
        background-color: rgba(153,153,153,0.9);
        color: #fff;
        position: absolute;
        right: -0.75em;
        top: -0.75em;
        z-index: 2;
        }
        .sidebar .sidebar-content .order-summary .product .product-image .product-thumbnail::after {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-radius: 8px;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.1) inset;
        }
        .sidebar .sidebar-content .order-summary .product .product-description {
        width: 100%;
        }
        .sidebar .sidebar-content .order-summary .product .product-description .product-description-name,
        .sidebar .sidebar-content .order-summary .product .product-description .product-description-variant,
        .sidebar .sidebar-content .order-summary .product .product-description .product-description-property {
        display: block;
        }
        .sidebar .sidebar-content .order-summary .product .product-quantity {
        }
        .sidebar .sidebar-content .order-summary .product .product-price {
        white-space: nowrap;
        }
        .sidebar .btn-disabled {
        cursor: default;
        background:  #c8c8c8;
        box-shadow: none;
        }
        .logo-text {
        color: #333333;
        }
        .main {
        }
        .main .main-header {
        }
        .main .main-header .logo {
        display: none;
        }
        .main .main-header .breadcrumb {
        }
        .main .main-header .breadcrumb .breadcrumb-item {
        display: inline-block;
        font-size: 0.85714em;
        color: #999999;
        }
        .main .main-header .breadcrumb .breadcrumb-item.breadcrumb-item-current {
        font-weight: 500;
        color: #4d4d4d;
        }
        .main .main-header .breadcrumb .breadcrumb-item:after {
        content: "";
        display: inline-block;
        width: 6px;
        height: 11px;
        vertical-align: middle;
        margin: 0 0.5em;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2IiBoZWlnaHQ9IjExIiBvcGFjaXR5PSIuNCIgZmlsbD0iIzAwMCI+PHBhdGggZD0iTS41MjYgMS40MDhsNCA0LjY0NS4wMTQtLjgzLTQgNC4zNTQuOTIuODQ2IDQtNC4zNTYuMzc2LS40MS0uMzYyLS40Mi00LTQuNjQ1LS45NDguODE2eiIvPjwvc3ZnPg=='),none;
        }
        .main .main-header .breadcrumb .breadcrumb-item:last-child:after {
        display: none;
        }
        .main .main-header .breadcrumb .breadcrumb-item .breadcrumb-link {
        cursor: pointer;
        }
        .main .main-footer {
        padding: 1em 0;
        border-top: 1px solid #e6e6e6;
        }
        .main h2 {
        color: #333333;
        }
        .field-label-strong {
        font-weight: 600;
        }
        .ctrl_payment_method {
        padding: 10px 60px;
        }
        .ctrl_payment_method > label {
        margin-bottom: 5px;
        display: block;
        }
        .ctrl_payment_method .payment_method_list {
        padding-left: 10px;
        }
        .total-line {
        }
        .total-line td {
        padding-top: 0.75em;
        }
        .total-line-table-footer .total-line td {
        padding-top: 3em;
        position: relative;
        }
        .total-line-table-footer .total-line td::before {
        background-color: #e1e1e1;
        content: '';
        position: absolute;
        top: 1.5em;
        left: 0;
        width: 100%;
        height: 1px;
        }
        .payment-due-label {
        }
        .payment-due-label .payment-due-label-total {
        font-size: 1.14286em;
        color: #4b4b4b;
        }
        .payment-due {
        }
        .payment-due .payment-due-currency {
        font-size: 0.85714em;
        vertical-align: 0.2em;
        margin-right: 0.5em;
        color: #969696;
        }
        .payment-due .payment-due-price {
        font-size: 1.71429em;
        font-weight: 500;
        letter-spacing: -0.04em;
        color: #4b4b4b;
        line-height: 1em;
        }
        .applied-reduction-code {
        margin-left: 0.5em;
        }
        .applied-reduction-code .applied-reduction-code-icon {
        fill: #338dbc;
        vertical-align: middle;
        margin-right: 0.14286em;
        }
        .applied-reduction-code .applied-reduction-code-information {
        font-size: 0.85714em;
        color: #338dbc;
        font-weight: 500;
        }
        .applied-reduction-code-clear-button {
        vertical-align: middle;
        margin-left: 0.28571em;
        }
        .hanging-icon {
        margin-right: 0.75em;
        stroke: #338dbc;
        }
        .hanging-icon.hanging-icon-error {
        stroke: #ff6d6d;
        }
        .os-header {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        margin: 0;
        }
        .os-header .os-header-heading {
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        }
        .os-header .os-header-heading .os-order-number {
        display: block;
        }
        .os-header .os-header-heading .os-header-title {
        font-size: 1.5em;
        margin-bottom: 0.1em;
        }
        .os-header .os-header-heading .os-description {
        color: #4d4d4d;
        }
        .wrap {
        margin: 0 auto;
        max-width: 40em;
        zoom: 1;
        }
        .wrap:after, .wrap:before {
        content: "";
        display: table;
        }
        .order-summary-toggle {
        background: #fafafa;
        border-top: 1px solid #e6e6e6;
        border-bottom: 1px solid #e6e6e6;
        padding: 1.25em 0;
        -webkit-flex-shrink: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        text-align: left;
        width: 100%;
        }
        .order-summary-toggle .order-summary-toggle-inner {
        display: table;
        box-sizing: border-box;
        width: 100%;
        zoom: 1;
        }
        .order-summary-toggle .order-summary-toggle-inner:after,
        .order-summary-toggle .order-summary-toggle-inner:before {
        content: "";
        display: table;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-icon-wrapper {
        display: table-cell;
        vertical-align: middle;
        padding-right: 0.75em;
        white-space: nowrap;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-icon-wrapper .order-summary-toggle-icon {
        fill: #338dbc ;
        transition: fill 0.2s ease-in-out;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-text {
        color:#338dbc;
        vertical-align: middle;
        transition: color 0.2s ease-in-out;
        display: none;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-text .order-summary-toggle-dropdown {
        vertical-align: middle;
        transition: fill 0.2s ease-in-out;
        fill: #338dbc;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-total-recap {
        display: table-cell;
        vertical-align: middle;
        text-align: right;
        padding-left: 0.75em;
        white-space: nowrap;
        }
        .order-summary-toggle .order-summary-toggle-inner .order-summary-toggle-total-recap .total-recap-final-price {
        font-size: 1.28571em;
        line-height: 1em;
        color: #4d4d4d;
        }
        .order-summary-toggle.order-summary-toggle-show {
        }
        .order-summary-toggle.order-summary-toggle-hide .order-summary-toggle-inner .order-summary-toggle-text.order-summary-toggle-text-show,
        .order-summary-toggle.order-summary-toggle-show .order-summary-toggle-inner .order-summary-toggle-text.order-summary-toggle-text-hide {
        display: table-cell;
        width: 100%;
        }
        .logged-in-customer-information {
        display: table;
        box-sizing: border-box;
        width: 100%;
        margin-bottom: 1.5em;
        }
        .logged-in-customer-information:after,
        .logged-in-customer-information:before {
        content: "";
        display: table;
        }
        .logged-in-customer-information .logged-in-customer-information-avatar-wrapper {
        display: table-cell;
        padding-right: 1em;
        white-space: nowrap;
        vertical-align: middle;
        }
        .logged-in-customer-information .logged-in-customer-information-avatar-wrapper .logged-in-customer-information-avatar {
        border-radius: 8px;
        background-size: cover;
        position: relative;
        max-width: none;
        width: 50px;
        height: 50px;
        overflow: hidden;
        }
        .logged-in-customer-information .logged-in-customer-information-avatar-wrapper .logged-in-customer-information-avatar:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDUwIDUwIj48dGl0bGU+QXJ0Ym9hcmQ8L3RpdGxlPjxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PHBhdGggZD0iTTAgMGg1MHY1MEgwVjB6IiBmaWxsPSIjRDhEOEQ4Ii8+PHBhdGggZD0iTTI1LjEwMyAyNi4yNDJjMy4yMTIgMCA1LjY0Mi0yLjkyIDUuNjQyLTYuNzg3IDAtMy4wODYtMi41OC01LjcwNS01LjY0Mi01LjcwNS0zLjA2IDAtNS42NCAyLjYyLTUuNjQgNS43MDUgMCAzLjg2NiAyLjQzIDYuNzg3IDUuNjQgNi43ODd6bTAtMTAuNTRjMS45NTIgMCAzLjY3OCAxLjc2MyAzLjY3OCAzLjc1MyAwIDIuNzU3LTEuNTc0IDQuODM1LTMuNjc3IDQuODM1LTIuMTAzIDAtMy42NzctMi4wNzgtMy42NzctNC44MzUgMC0xLjk5IDEuNzI2LTMuNzUzIDMuNjc3LTMuNzUzem0tOC40NSAyMC42MTVsLjE3Ny0xLjg3N2MuMzktMy43NzggNC42OTctNC42MSA4LjI3My00LjYxIDMuNTc3IDAgNy44ODQuODMyIDguMjc0IDQuNTk4bC4xNzYgMS44OWgyLjAxNWwtLjE3Ni0yLjA4Yy0uNDQtNC4xMTctNC4wNjgtNi4zODQtMTAuMjktNi4zODQtNi4yMiAwLTkuODQ2IDIuMjY3LTEwLjI4NyA2LjM5N2wtLjE3NiAyLjA2N2gyLjAxNHoiIGZpbGw9IiNGRkYiLz48L2c+PC9zdmc+'),none;
        }
        .logged-in-customer-information .logged-in-customer-information-paragraph {
        display: table-cell;
        width: 100%;
        padding-top: 0.25em;
        vertical-align: middle;
        }
        @media (min-width: 1300px) {
        .hanging-icon {
        position: absolute;
        right: 100%;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-right: 1.5em;
        }
        }
        @media (min-width: 1000px) {
        .wrap {
        padding: 0 5%;
        width: 90%;
        max-width: 78.57143em;
        }
        .order-summary-toggle {
        display: none;
        }
        .flexbox .content .wrap {
        -webkit-flex-direction: row-reverse;
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse;
        }
        .main {
        width: 52%;
        width: 52%;
        padding-right: 6%;
        /* float: left;*/
        }
        .main .main-header {
        padding-bottom: 1em;
        }
        .main .main-header .logo {
        display: block;
        }
        .main .main-header .breadcrumb {
        margin-top: 1em;
        }
        .sidebar {
        width: 38%;
        padding-left: 4%;
        background-position: left top;
        /* float: right; */
        }
        .sidebar:after {
        left: 0;
        background-position: left top;
        box-shadow: 1px 0 0 #e1e1e1 inset;
        }
        .sidebar .sidebar-content .order-summary .order-summary-sections .order-summary-section:first-child {
        padding-top: 0;
        }
        }
        @media (max-width: 999px) {
        .content {
        }
        .content.content-second {
        display: block;
        }
        .wrap {
        width: 100%;
        box-sizing: border-box;
        padding: 0 1em;
        }
        .banner {
        display: block;
        }
        .banner.error{
        padding-bottom: 100px;
        }
        #checkout_order_information_changed_error_message {
        position: absolute;
        top: 60px;
        left: 15px;
        width: calc(100% - 30px);
        margin-bottom: 0 !important;
        }
        .main .main-header .breadcrumb {
        display: none;
        }
        .sidebar .sidebar-content .order-summary.order-summary-is-collapsed {
        height: 0;
        overflow: hidden;
        }
        }
        @media (max-width: 999px) and (min-width: 750px) {
        .hanging-icon {
        position: absolute;
        right: 100%;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-right: 1.5em;
        }
        }
        @media (min-width: 750px) {
        h1 {
        font-size: 2em;
        }
        .main {
        padding-top: 1.5em;
        }
        .main .main-content {
        padding-bottom: 4em;
        }
        .step-footer {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: row-reverse;
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        margin-top: 1.5em;
        }
        .step-footer .step-footer-continue-btn {
        -webkit-flex: 0 0 auto;
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        float: right;
        }
        .step-footer .step-footer-previous-link {
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        margin-right: 1em;
        float: left;
        display: block;
        }
        .step-footer .step-footer-info {
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        margin-right: 1em;
        float: left;
        }
        .section {
        padding-top: 3em;
        }
        .section.thank-you-checkout-info {
        padding-top: 1.5em;
        }
        .section .section-header {
        margin-bottom: 1.5em;
        }
        .field-half {
        width: 50% !important;
        }
        .field-two-thirds {
        width: 66.66667% !important;
        }
        .field-third {
        width: 33.33333% !important;
        }
        .os-header {
        margin: 0 0 -0.5em !important;
        }
        .icon {
        }
        .icon.icon-closed-box {
        width: 108px;
        height: 85px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDgiIGhlaWdodD0iODUiIHZpZXdCb3g9IjAgMCAxMDggODUiPjxnIHN0cm9rZT0iI0IyQjJCMiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGZpbGw9Im5vbmUiPjxwYXRoIGQ9Ik0xIDE4aDEwNk0xMSA3MC4zaDI2bS0yNi02aDI2bS0yNi02aDE3Ii8+PC9nPjxwYXRoIHN0cm9rZT0iI0IyQjJCMiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGQ9Ik0xIDE4bDEwLjctMTdoODQuN2wxMC42IDE3djYxLjVjMCAyLjUtMiA0LjUtNC41IDQuNWgtOTdjLTIuNSAwLTQuNS0yLTQuNS00LjV2LTYxLjV6TTU0IDF2MTYuNiIgZmlsbD0ibm9uZSIvPjwvc3ZnPg=='),none;
        }
        .icon.icon-closed-box.has-error {
        width: 108px;
        height: 85px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDgiIGhlaWdodD0iODUiIHZpZXdCb3g9IjAgMCAxMDggODUiPjxnIHN0cm9rZT0iI2ZmNmQ2ZCIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGZpbGw9Im5vbmUiPjxwYXRoIGQ9Ik0xIDE4aDEwNk0xMSA3MC4zaDI2bS0yNi02aDI2bS0yNi02aDE3Ii8+PC9nPjxwYXRoIHN0cm9rZT0iI2ZmNmQ2ZCIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIGQ9Ik0xIDE4bDEwLjctMTdoODQuN2wxMC42IDE3djYxLjVjMCAyLjUtMiA0LjUtNC41IDQuNWgtOTdjLTIuNSAwLTQuNS0yLTQuNS00LjV2LTYxLjV6TTU0IDF2MTYuNiIgZmlsbD0ibm9uZSIvPjwvc3ZnPg=='),none;
        }
        }
        @media (min-width: 1000px) {
        .main, .sidebar {
        padding-top: 4em;
        }
        }
        .text-center {
        text-align: center;
        }
        @media (max-width: 749px) {
        .modal-container {
        display: block;
        }
        .tool-tip__info, .tool-tip {
        display: none !important;
        }
        .main {
        padding-top: 1.5em;
        }
        .main .main-content {
        padding-bottom: 1.5em;
        }
        .section-header {
        margin-bottom: 1em;
        }
        .text-center {
        text-align: left;
        }
        .btn {
        width: 100%;
        padding-top: 1.75em;
        padding-bottom: 1.75em;
        }
        .step-footer {
        }
        .step-footer .step-footer-previous-link {
        padding-top: 1.5em;
        text-align: center;
        }
        .step-footer .step-footer-info {
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding-top: 1.5em;
        text-align: center;
        }
        }
        .thank-you-additional-content {
        margin-top: 15px;
        line-height: 1.25em;
        }
        .blank-slate {
        white-space: pre-line;
        padding: 1.5em;
        text-align: center;
        }
        .paylater {
        padding: .8em;
        white-space: normal;
        }
        .paylater--ul {
        list-style-type: disc;
        padding:0 2em ;
        padding-right: 1em;
        word-break: break-word;
        }
        .paylater--ul li {
        margin: 5px;
        text-align: justify;
        }
        .blank-slate .blank-slate-icon {
        margin-bottom: 1em;
        }
        .dp-none {
        display: none;
        }
        .dp-inline-block {
        display: inline-block;
        }
        .visually-hidden {
        border: 0;
        clip: rect(0, 0, 0, 0);
        clip: rect(0 0 0 0);
        width: 2px;
        height: 2px;
        margin: -2px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        }
        .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
        }
        .group:after {
        content: "";
        display: table;
        clear: both;
        }
        .pt0 {
        padding-top: 0px !important;
        }
        .mt0 {
        margin-top: 0px !important;
        }
        .mb5 {
        margin-bottom: 5px;
        }
        .hidden {
        display: none !important;
        }
        form#form_update_shipping_method {
        position: relative;
        }
        .footer-powered-by {
        text-align: center;
        color: #4B5563;
        font-size: 0.9em;
        }
        .order-checkout__loading {
        position: static;
        }
        .order-checkout__loading--box {
        position: absolute;
        left: 0;
        top: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        display: -webkit-flex;
        display: flex;
        opacity: 0;
        visibility: hidden;
        justify-content: center;
        align-items: center;
        padding: 0;
        }
        .checkout-payment__loading--box {
        position: relative;
        left: 0;
        top: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        display: -webkit-flex;
        display: flex;
        opacity: 0;
        visibility: hidden;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 0;
        }
        .checkout-payment__loading--box p {
        margin-top:1em;
        }
        .checkout-payment__loading--box.show {
        z-index: 2;
        visibility: visible;
        opacity: 1;
        padding-top: 25px;
        padding-bottom: 25px;
        }
        .order-checkout__loading--box.show {
        z-index: 2;
        visibility: visible;
        opacity: 1;
        }
        .order-checkout__loading--circle {
        border: 2px solid #f3f3f3;
        border-top: 2px solid #5cabe0;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        margin: 0;
        -webkit-transform-origin: 50%;
        -o-transform-origin: 50%;
        -ms-transform-origin: 50%;
        transform-origin: 50%;
        -moz-animation: spin 700ms infinite linear;
        -ms-animation: spin 1.5s infinite linear;
        -webkit-animation: spin 700ms infinite linear;
        -o-animation: spin 700ms infinite linear;
        animation: spin 700ms infinite linear;
        z-index: 1;
        }
        .order-checkout__loading--box.show:after {
        content: "";
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        z-index: 3;
        }
        .step-sections {
        position: relative;
        z-index: 3;
        }
        @media (max-width: 767px) {
        .order-checkout__loading--box {
        position: fixed;
        }
        .order-checkout__loading--box.show:after {
        display: none;
        }
        }
        .order-checkout__loading--show .order-checkout__loading--box {
        display: block;
        }
        @-moz-keyframes spin {
        100% {
        -moz-transform: rotate(360deg);
        }
        }
        @-webkit-keyframes spin {
        100% {
        -webkit-transform: rotate(360deg);
        }
        }
        @keyframes spin {
        100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
        }
        }
        .redeem-login {
        display: flex;
        align-items: center;
        justify-content: space-between;
        }
        .redeem-login-title {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        }
        .redeem-login-title h2 {
        color: #333;
        margin-right: 5px;
        }
        .redeem-login-btn a {
        display: inline-block;
        border-radius: 4px;
        font-weight: 500;
        padding: 13px 10px;
        background: #338dbc;
        color: #fff;
        width: 82px;
        text-align: center;
        }
        .redeem-login-btn a:hover,.redeem-login-btn a:focus{
        filter: brightness(1.2);
        }
        .redeem-form-used {
        padding-top: 10px;
        }
        .btn-redeem-loading .btn-redeem-spinner {
        -webkit-animation: rotate 0.5s linear infinite;
        animation: rotate 0.5s linear infinite;
        opacity: 1;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=" 100 ")";
        filter: alpha(opacity=100);
        }
        .icon-redeem-button-spinner {
        position: absolute;
        top: 0;
        opacity: 0;
        right: -25px;
        width: 12px;
        height: 12px;
        border: 2px solid #999999;
        border-bottom-color: transparent;
        border-radius: 100%;
        }
        .total-line-table-footer {
        white-space: nowrap;
        }
        .row-align-top {
        vertical-align: top;
        }
        .section .section-content #form_update_shipping_method.default .content-box .content-box-row.content-box-row-secondary {
        padding: 0;
        background: transparent;
        border: none !important;
        margin: 0;
        width: 100%;
        display: block;
        box-shadow: unset !important;
        }
        form#form_update_shipping_method.default {
        padding: 0;
        }
        #form_update_shipping_method.default .content-box {
        box-shadow: unset;
        }
        .hrv-discount-choose-coupons {
        cursor: pointer;
        display: -webkit-flex;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        color: #338dbc;
        }
        .hrv-discount-choose-coupons #list_short_coupon {display: -webkit-flex; display: flex; flex-wrap: wrap; justify-content: flex-start; width: 100%;}
        .hrv-discount-choose-coupons > div:first-child { flex: 0 0 100%; margin-bottom: 10px; }
        .hrv-discount-choose-coupons #list_short_coupon > span:not(:last-child) {margin-right: 5px;}
        .hrv-discount-choose-coupons #list_short_coupon > span {overflow: hidden;padding: 6px 0;position: relative; margin-bottom: 5px;}
        .hrv-discount-choose-coupons #list_short_coupon > span span {
        border: 1px solid #338dbc;
        padding: 5px 10px;
        border-radius: 3px;
        background: #fff;
        font-weight: 700;
        color: #338dbc
        }
        .hrv-discount-choose-coupons #list_short_coupon > span:before {
        content: "";
        display: block;
        width: 10px; height: 10px;
        border: 1px solid #338dbc;
        background: #fff;
        z-index: 1; left: -7px; top: 50%;
        position: absolute;
        border-radius: 50%;
        transform: translateY(-50%);
        }
        .hrv-discount-choose-coupons #list_short_coupon > span:after {
        content: "";
        display: block;
        width: 10px; height: 10px;
        border:1px solid #338dbc;
        background: #fff;
        z-index: 1; right: -7px; top: 50%;
        position: absolute;
        border-radius: 50%;
        transform: translateY(-50%);
        }
        .hrv-coupons-popup{
        width: 375px;
        transition: opacity 0.5s ease-out;
        padding: 0;
        opacity: 1;
        position: fixed;
        background: #FFFFFF;
        box-shadow: 0px 0px 20px rgb(33 33 33 / 20%);
        border-radius: 8px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-height: 70vh;
        min-height: 500px;
        z-index: 1234;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-out;
        display: -webkit-flex;
        display: flex;
        flex-direction: column;
        }
        .hrv-title-coupons-popup {
        display: flex;
        padding: 19px 16px;
        width: calc(100% - 32px);
        position: relative;
        box-shadow: inset 0px -1px 0px #eeeeee;
        }
        .hrv-title-coupons-popup p {
        width: 100%;
        font-weight: 500;
        font-size: 20px;
        line-height: 22px;
        padding-right: 60px;
        color: #424242;
        }
        .hrv-title-coupons-popup div {
        width: 60px;
        height: 100%;
        position: absolute;
        right: 0;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5;
        }
        .hrv-title-coupons-popup div svg {
        float: right;
        cursor: pointer;
        }
        .hrv-coupons-popup-site-overlay{
        background: #CFCFCF;
        position: fixed;
        opacity: 0.6 !important;
        top: 0px;
        right: 0px;
        left: 0px;
        bottom: 0px;
        z-index: 123;
        visibility: hidden;
        }
        .hrv-content-coupons-code {
        overflow-x: hidden !important;
        overflow-y: auto;
        max-height: calc(100% - 82px);
        padding: 11px 12.5px;
        }
        div[class*="hrv-discount-code-"].open-more .text-center span:last-child {
        transform: rotate(180deg);
        display: inline-block;
        }
        h3.coupon_heading {
        font-size: 16px;
        line-height: 22px;
        font-weight: 500;
        padding: 0 3.5px;
        width: 100%;
        color: #424242;
        }
        @-webkit-keyframes pulse {
        0% {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0); }
        50% {
        -webkit-transform: translate(0, 10px);
        transform: translate(0, 10px); }
        100% {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0); }
        }
        @keyframes pulse {
        0% {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0); }
        50% {
        -webkit-transform: translate(0, 10px);
        transform: translate(0, 10px); }
        100% {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0); }
        }
        #show_all_coupon{
        /*-webkit-animation: pulse 1s infinite;
        animation: pulse 2s infinite;*/
        height: 40px;
        width: 100%;
        color: #338dbc;
        }
        #show_all_coupon svg {
        fill: #338dbc;
        width: 15px;
        position: relative;
        }
        .active-popup{
        opacity: 1;
        visibility: visible;
        }
        .hrv-content-coupons-code .coupon_icon {
        display: flex;
        width: 100%;
        align-items: center;
        }
        .hrv-content-coupons-code .coupon_item {
        position: relative;
        background: #fff;
        filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, .15));
        padding: 10px 16px;
        display: flex;
        min-height: 80px;
        border-radius: 5px;
        margin: 5px 0px 15px 2px;
        }
        .hrv-content-coupons-code::-webkit-scrollbar {
        width: 8px;
        background-color: transparent;
        }
        .hrv-content-coupons-code::-webkit-scrollbar-thumb {
        background-color: #e0e0e0;
        border-radius: 4px;
        }
        .hrv-content-coupons-code .coupon_item:before {
        content: "";
        display: none;
        position: absolute;
        top: 0;
        left: -3px;
        height: 100%;
        width: 10px;
        color: #fff;
        background-clip: padding-box;
        background: repeating-linear-gradient(#e5e5e5,#e5e5e5 5px,transparent 0,transparent 9px,#e5e5e5 0,#e5e5e5 10px) 0/1px 100% no-repeat,radial-gradient(circle at 0 7px,transparent,transparent 2px,#e5e5e5ee 0,#e5e5e5 3px,currentColor 0) 1px 0/100% 10px repeat-y;
        }
        .hrv-content-coupons-code .coupon_icon > div {flex: 0 0 auto;}
        .hrv-content-coupons-code .coupon_icon .icon-svg {
        width: 37px;
        flex: 0 0 auto;
        margin-right: 10px;
        text-align: center;
        }
        .hrv-content-coupons-code .coupon_icon .icon-svg svg{
        width: 100%;
        }
        .hrv-content-coupons-code .coupon_body {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
        position: relative;
        }
        .hrv-content-coupons-code .coupon_body .coupon_head {
        width: 100%;
        display: -webkit-flex;
        display: flex;
        align-items: center;
        /* margin-bottom: 10px;
        position: relative;*/
        }
        .coupon_layer {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        }
        .hrv-content-coupons-code .coupon_item h3.coupon_title {
        font-size: 16px;
        width: calc(100% - 47px);
        margin: 0.25em 0 5px;
        }
        .hrv-content-coupons-code .coupon_item h3.coupon_title span {
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
        color: #212121;
        }
        .hrv-content-coupons-code .coupon_item .coupon_desc{ display: none; position: relative; z-index: 2; }
        .hrv-content-coupons-code .coupon_item .coupon_desc ul,
        .hrv-content-coupons-code .coupon_item .coupon_desc_short ul{
        list-style: initial;
        list-style-position: outside;
        padding-left: 18px;
        }
        .hrv-content-coupons-code .coupon_item .coupon_desc_short.close{ display: none; }
        .hrv-content-coupons-code .coupon_item .coupon_desc_short.close + .coupon_desc{ display: block; }
        .hrv-content-coupons-code .coupon_item div[class*="coupon_desc"] {
        width: 100%; font-size: 14px; color: #212121;
        }
        .hrv-content-coupons-code .coupon_item div[class*="coupon_desc"] ul li a {display: block;margin-bottom: 5px;}
        .hrv-content-coupons-code .coupon_item div[class*="coupon_desc"] ul li a:before{ content: "-"; margin-right: 5px }
        .hrv-content-coupons-code .coupon_item div[class*="coupon_desc"] ul li br {display: none;}
        .hrv-content-coupons-code .coupon_item div[class*="coupon_desc"] ul li a:first-child {margin-top: 5px;}
        .hrv-content-coupons-code .coupon_item .coupon_actions {
        display: -webkit-flex;
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        }
        .hrv-content-coupons-code .coupon_item .coupon_more{
        cursor: pointer;
        color: #338dbc;
        margin-top: 0px;
        position: relative;
        z-index: 2;
        font-size: 14px;
        }
        .hrv-content-coupons-code .coupon_item .coupon_more.open {font-size: 0px;}
        .hrv-content-coupons-code .coupon_item .coupon_more.open:before {content: "Thu gọn";font-size:  14px;}
        .hrv-content-coupons-code .coupon_item .coupon_exp {
        max-width: calc(100% - 75px);
        line-height: 20px;
        margin-top: 0px;
        font-size: 14px;
        }
        .hrv-content-coupons-code .coupon_item .coupon_more svg {
        fill: #338bdc;
        width: 10px;
        margin-left: 8px;
        }
        .hrv-content-coupons-code .coupon_item .coupon_more.open svg {
        transform: rotate(180deg);
        }
        .hrv-content-coupons-code .coupon_item .coupon_more.open #show_all_icon {
        transform: rotate(180deg);
        }
        .btn_apply_line_coupon {
        height: 32px;
        padding: 5px 10px !important;
        width: auto !important;
        background: #338dbc;
        }
        @media screen and (max-width: 767px){
        .hrv-content-coupons-code .coupon_item {
        padding: 5px 12.5px;
        width: calc(100% - 25px);
        margin: 5px 0 15px;
        }
        .hrv-coupons-popup {
        width: 100%;
        top: unset;
        bottom: 0;
        left: 0;
        height: 80vh;
        min-height: unset;
        max-height: unset;
        border-radius: 8px 8px 0 0;
        transform: translate(0,0);
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
        -webkit-transition: transform 0.35s ease,bottom 0.25s ease, visibility 0s;
        transition: transform 0.3;
        }
        .hrv-coupons-popup.active-popup {
        max-height: calc(100% - 60px);
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-transition-delay: 0.1s;
        transition-delay: 0.1s;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        }
        .hrv-content-coupons-code .coupon_icon{ padding: 10px 0; }
        }
        .sidebar .sidebar-content .order-summary .order-summary-sections .order-summary-section[data-order-summary-section="discount-display"] {
        padding: 0px;
        border-top: 0px;
        padding-bottom: 1.5em;
        }
        .order-summary-section.order-summary-section-total-lines.payment-lines[data-order-summary-section="payment-lines"] {
        padding-top: 1em !important;
        }
    </style>
    <link href='/site/css/check_out.css?v=1811' rel='stylesheet' type='text/css'  media='all'  />
    <script src='//hstatic.net/0/0/global/jquery.min.js' type='text/javascript'></script>
    {{-- <script src='//hstatic.net/0/0/global/api.jquery.js' type='text/javascript'></script>
    <script src='//hstatic.net/0/0/global/jquery.validate.js' type='text/javascript'></script> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no">
    <script type="text/javascript">
        var toggleShowOrderSummary = false;
        $(document).ready(function() {
            $('body')
                .on('click', '.order-summary-toggle', function() {
                    toggleShowOrderSummary = !toggleShowOrderSummary;

                    if(toggleShowOrderSummary) {
                        $('.order-summary-toggle')
                            .removeClass('order-summary-toggle-hide')
                            .addClass('order-summary-toggle-show');

                        $('.sidebar:not(".sidebar-second") .sidebar-content .order-summary')
                            .removeClass('order-summary-is-collapsed')
                            .addClass('order-summary-is-expanded');

                        $('.sidebar.sidebar-second .sidebar-content .order-summary')
                            .removeClass('order-summary-is-expanded')
                            .addClass('order-summary-is-collapsed');
                    } else {
                        $('.order-summary-toggle')
                            .removeClass('order-summary-toggle-show')
                            .addClass('order-summary-toggle-hide');

                        $('.sidebar:not(".sidebar-second") .sidebar-content .order-summary')
                            .removeClass('order-summary-is-expanded')
                            .addClass('order-summary-is-collapsed');

                        $('.sidebar.sidebar-second .sidebar-content .order-summary')
                            .removeClass('order-summary-is-collapsed')
                            .addClass('order-summary-is-expanded');
                    }
                });
        });
    </script>
</head>
<body>
    <div class="banner">
        <div class="wrap">
            <a href="{{route('front.home-page')}}" class="logo">
            <h1 class="logo-text">{{$config->web_title}}</h1>
            </a>
        </div>
    </div>
    <button class="order-summary-toggle order-summary-toggle-hide">
        <div class="wrap">
            <div class="order-summary-toggle-inner">
            <div class="order-summary-toggle-icon-wrapper">
                <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-icon">
                    <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"></path>
                </svg>
            </div>
            <div class="order-summary-toggle-text order-summary-toggle-text-show">
                <span>Hiển thị thông tin đơn hàng</span>
                <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown" fill="#000">
                    <path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path>
                </svg>
            </div>
            <div class="order-summary-toggle-text order-summary-toggle-text-hide">
                <span>Ẩn thông tin đơn hàng</span>
                <svg width="11" height="7" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown" fill="#000">
                    <path d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z"></path>
                </svg>
            </div>
            <div class="order-summary-toggle-total-recap">
                <span class="total-recap-final-price">{{formatCurrency($order->total_after_discount)}}₫</span>
            </div>
            </div>
        </div>
    </button>
    <div class="content content-second">
        <div class="wrap">
            <div class="sidebar sidebar-second">
            <div class="sidebar-content">
                <div class="order-summary">
                    <div class="order-summary-sections">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="wrap">
            <div class="sidebar">
            <div class="sidebar-content">
                <div class="order-summary order-summary-is-collapsed">
                    <h2 class="visually-hidden">Thông tin đơn hàng</h2>
                    <div class="order-summary-sections">
                        <div class="order-summary-section order-summary-section-product-list" data-order-summary-section="line-items">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th scope="col"><span class="visually-hidden">Hình ảnh</span></th>
                                    <th scope="col"><span class="visually-hidden">Mô tả</span></th>
                                    <th scope="col"><span class="visually-hidden">Số lượng</span></th>
                                    <th scope="col"><span class="visually-hidden">Giá</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $detail)
                                <tr class="product">
                                    <td class="product-image">
                                    <div class="product-thumbnail">
                                        <div class="product-thumbnail-wrapper">
                                            <img class="product-thumbnail-image" alt="{{$detail->product ? $detail->product->name : 'Không có sản phẩm'}}" src="{{$detail->product ? $detail->product->image->path : '/site/images/no-image.png'}}" />
                                            </div>
                                            <span class="product-thumbnail-quantity" aria-hidden="true">{{$detail->qty}}</span>
                                        </div>
                                    </td>
                                    <td class="product-description">
                                    <span class="product-description-name order-summary-emphasis">{{$detail->product ? $detail->product->name : 'Không có sản phẩm'}}</span>
                                    @php
                                    $attributes = json_decode($detail->attributes, true);
                                    @endphp
                                    @if($attributes)
                                    <span class="product-description-variant order-summary-small-text">
                                    @foreach($attributes as $attribute)
                                    {{$attribute['name']}}: <span style="font-weight: 400; color: #338dbc;">{{$attribute['value']}}</span>
                                    @endforeach
                                    </span>
                                    @endif
                                    </td>
                                    <td class="product-quantity visually-hidden">{{$detail->qty}}</td>
                                    <td class="product-price">
                                    <span class="order-summary-emphasis">{{formatCurrency($detail->price)}}₫</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="order-summary-section order-summary-section-total-lines payment-lines" data-order-summary-section="payment-lines">
                        <table class="total-line-table">
                            <thead>
                                <tr>
                                    <th scope="col"><span class="visually-hidden">Mô tả</span></th>
                                    <th scope="col"><span class="visually-hidden">Giá</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-line total-line-subtotal">
                                    <td class="total-line-name">Tạm tính</td>
                                    <td class="total-line-price">
                                    <span class="order-summary-emphasis">
                                    {{formatCurrency($order->total_before_discount)}}₫
                                    </span>
                                    </td>
                                </tr>
                                <tr class="total-line total-line-shipping">
                                    <td class="total-line-name">Giảm giá</td>
                                    <td class="total-line-price">
                                    <span class="order-summary-emphasis">
                                    {{formatCurrency($order->discount_value)}}₫
                                    </span>
                                    </td>
                                </tr>
                                <tr class="total-line total-line-shipping">
                                    <td class="total-line-name">Phí vận chuyển</td>
                                    <td class="total-line-price">
                                    <span class="order-summary-emphasis">
                                    {{formatCurrency(22000)}}₫
                                    </span>
                                    </td>
                                </tr>
                                @if (Auth::guard('client')->check())
                                <tr class="total-line total-line-point">
                                    <td class="total-line-name">Điểm quy đổi ({{$order->point ?? 0}} điểm)</td>
                                    <td class="total-line-price">
                                    <span class="order-summary-emphasis">
                                    {{formatCurrency($order->point_value)}}₫
                                    </span>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot class="total-line-table-footer">
                                <tr class="total-line">
                                    <td class="total-line-name payment-due-label">
                                    <span class="payment-due-label-total">Tổng cộng</span>
                                    </td>
                                    <td class="total-line-name payment-due">
                                    <span class="payment-due-currency">VND</span>
                                    <span class="payment-due-price">
                                    {{formatCurrency($order->total_after_discount)}}₫
                                    </span>
                                    <span class="checkout_version" display:none data_checkout_version="0">
                                    </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="main">
            <div class="main-header">
                <a href="{{route('front.home-page')}}" class="logo">
                    <h1 class="logo-text">{{$config->web_title}}</h1>
                </a>
                <style>
                    a.logo{display: block;}
                    .logo-cus{
                    width: 100%; padding: 15px 0;
                    text-align: ;
                    }
                    .logo-cus img{ max-height: 4.2857142857em  }
                    .logo-text{
                    text-align: ;
                    }
                    @media (max-width: 767px){
                    .banner a{ display: block; }
                    }
                </style>
            </div>
            <div class="main-content">
                <div >
                    <div class="section">
                        <div class="section-header os-header">
                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000" stroke-width="2" class="hanging-icon checkmark">
                            <path class="checkmark_circle" d="M25 49c13.255 0 24-10.745 24-24S38.255 1 25 1 1 11.745 1 25s10.745 24 24 24z"></path>
                            <path class="checkmark_check" d="M15 24.51l7.307 7.308L35.125 19"></path>
                        </svg>
                        <div class="os-header-heading">
                            <h2 class="os-header-title">
                                Đơn hàng đã được khởi tạo
                            </h2>
                            <span class="os-order-number">
                            Mã đơn hàng #{{$order->code}}
                            </span>
                            <span class="os-description">
                                Cảm ơn bạn đã mua hàng, vui lòng xác nhận thông tin của bạn để hoàn tất đơn hàng
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="thank-you-additional-content">
                        <script src="https://qr.sepay.vn/haravan.js?d=eyJiYW5rX2JpbiI6OTcwNDIyLCJiYW5rX2NvZGUiOiJNQiIsImFjY291bnRfbnVtYmVyIjoiMTkwMDEzNjg2OCIsInByZWZpeCI6IkRIIiwiYmFua19icmFuZF9uYW1lIjoiTUJCYW5rIiwiYWNjb3VudF9uYW1lIjoiQlVJIFRISSBQSFVPTkcgQU5IIn0="></script>
                    </div>
                    <div class="section thank-you-checkout-info">
                        <div class="section-content">
                        <div class="content-box">
                            <div class="content-box-row content-box-row-padding content-box-row-no-border">
                                <h2>Thông tin đơn hàng</h2>
                            </div>
                            <div class="content-box-row content-box-row-padding">
                                <div class="section-content">
                                    <div class="section-content-column">
                                    <h3>Thông tin giao hàng</h3>
                                    {{$order->customer_name}}
                                    </br>
                                    {{$order->customer_phone}}
                                    </br>
                                    <p>
                                        {{$order->customer_address}}
                                    </p>
                                    <h3>Phương thức thanh toán</h3>
                                    <p>
                                        Thanh toán khi nhận hàng
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="step-footer">
                        <a href="{{route('front.home-page')}}" class="step-footer-continue-btn btn">
                        <span class="btn-content">Xác nhận mua hàng</span>
                        </a>
                        <p class="step-footer-info">
                        <i class="icon icon-os-question"></i>
                        <span>
                        Cần hỗ trợ? <a href="mailto:{{$config->email}}">Liên hệ chúng tôi</a>
                        </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="hrv-coupons-popup-site-overlay"></div>
            <div class="main-footer footer-powered-by">Powered by {{$config->web_title}}</div>
            </div>
        </div>
    </div>
</body>
</html>
