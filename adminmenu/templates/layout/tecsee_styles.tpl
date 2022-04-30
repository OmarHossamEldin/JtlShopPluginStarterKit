<style>
    *{ldelim}margin: 0;padding: 0;-webkit-box-sizing: border-box;box-sizing: border-box;outline: none;border: none;text-transform: capitalize;-webkit-transition: all 0.2s ease-out;transition: all 0.2s ease-out;text-decoration: none;{rdelim}
    .tecSee-table-parent .tecSee-table-title-and-search{ldelim}display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;padding: 15px;-webkit-box-align: center;-ms-flex-align: center;align-items: center;{rdelim}
    .tecSee-table-parent .tecSee-table-title-and-search h2{ldelim}margin: 0;padding: 0;font-weight: 900;font-size: 25px;-ms-flex-preferred-size: 40%;flex-basis: 40%;{rdelim}
    .tecSee-table-parent .tecSee-table-title-and-search input[type="search"]{ldelim}border: 1px solid #b3b3b3;border-radius: 5px;-ms-flex-preferred-size: 30%;flex-basis: 30%;padding: 15px;font-size: 18px;{rdelim}
    .tecSee-table-parent .tecSee-table-container{ldelim}width: 100%;overflow: hidden;{rdelim}
    .tecSee-table-parent .tecSee-table-container{ldelim}width: 100%;overflow: hidden;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding{ldelim}width: 100%;overflow: auto;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding::-webkit-scrollbar-track{ldelim}background-color: #f1f2f6;border-radius: 15px;width: 10px;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding::-webkit-scrollbar{ldelim}background: white;border-radius: 15px;width: 10px;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding::-webkit-scrollbar-thumb{ldelim}background-color: #5cbcf6;border-radius: 15px;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table{ldelim}width: 100%;border-collapse: collapse;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table th{ldelim}background-color: #5cbcf6;padding: 15px;color: white;border: 1px solid #b3b3b3;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td{ldelim}padding: 15px;border: 1px solid #b3b3b3;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td:nth-child(odd){ldelim}background-color: #e9ecf8;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td p{ldelim}max-width: 200px;width: -webkit-fit-content;width: -moz-fit-content;width: fit-content;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td button{ldelim}padding: 15px;border-radius: 5px;color: white;cursor: pointer;font-size: 18px;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td button.tecSee-button-click{ldelim}background-color: #5cbcf6;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td button.tecSee-button-edit{ldelim}background-color: #0b6aa2;{rdelim}
    .tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table tr td button.tecSee-button-delete{ldelim}background-color: #e10505;{rdelim}
    .tecSee-form .tecSee-invalid{ldelim}border: #ff4949 solid 2px{rdelim}
    .tecSee-form{ldelim}display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin: 10px 0;{rdelim}
    .tecSee-form div,.tecSee-form .full-width{ldelim}margin: 0 10px 0 20px;-ms-flex-preferred-size: calc((100% - 60px) / 2);flex-basis: calc((100% - 60px) / 2);display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;gap: 20px;padding: 15px;{rdelim}
    .tecSee-form div.tecSee-break,.tecSee-form .full-width.tecSee-break{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;height: 0;{rdelim}
    .tecSee-form div label,.tecSee-form .full-width label{ldelim}font-size: 18px;font-weight: bolder;{rdelim}.tecSee-form div input,.tecSee-form div textarea,.tecSee-form div select,.tecSee-form .full-width input,.tecSee-form .full-width select{ldelim}padding: 15px;border-radius: 5px;border: 1px solid #b3b3b3;resize:none;{rdelim}
    .tecSee-form div select option,.tecSee-form .full-width select option{ldelim}font-size: 17px;{rdelim}
    .tecSee-form .full-width{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}
    .tecSee-form button,.tecSee-form input[type="submit"]{ldelim}-ms-flex-preferred-size: calc((100% - 60px) / 2);flex-basis: calc((100% - 60px) / 2);background-color: #5cbcf6;border-radius: 5px;padding: 15px;color: #e9ecf8;display: block;margin: 0 auto;{rdelim}
    .tecSee-form .triple-div{ldelim}flex-basis: calc((100% - 60px) / 4);{rdelim}
    .tecSee-form .plus-button{ldelim}flex-basis: calc((100% - 60px) / 10);height: fit-content;margin-top: 7%;{rdelim}
    .tecSee-icon{rdelim}border:0px;font-weight: bold;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form{ldelim}height: fit-content;display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin: 10px 0;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form div,.tecSee-form .full-width{ldelim}margin: 0 10px 0 20px;-ms-flex-preferred-size: 100%;flex-basis: 100%;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;gap: 20px;padding: 15px;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form div.tecSee-break,.tecSee-form .full-width.tecSee-break{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;height: 0;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form div label,.tecSee-form .full-width label{ldelim}font-size: 18px;font-weight: bolder;{rdelim}.tecSee-form div input,.tecSee-form div textarea,.tecSee-form div select,.tecSee-form .full-width input,.tecSee-form .full-width select{ldelim}padding: 15px;border-radius: 5px;border: 1px solid #b3b3b3;resize:none;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form div select option,.tecSee-form .full-width select option{ldelim}font-size: 17px;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form .full-width{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form button,.tecSee-form input[type="submit"]{ldelim}-ms-flex-preferred-size: calc((100% - 60px) / 2);flex-basis: calc((100% - 60px) / 2);background-color: #5cbcf6;border-radius: 5px;padding: 15px;color: #e9ecf8;display: block;margin: 0 auto;{rdelim}
    .modal {ldelim}width: 50%;margin: 0 auto;background-color:unset;left: 50%; transform: translateX(-50%);max-height: 90vh;top: 5%; bottom: 10%; padding:0;{rdelim}
    .modal .modal-dialog .modal-header{ldelim}position: relative;{rdelim}
    .modal .modal-dialog .modal-header h4{ldelim}font-weight: 900;font-size: 20px;text-align: center;padding: 15px;{rdelim}
    .modal .modal-dialog .modal-header i{ldelim}color: #e10505;position: absolute;top: 5px;right: 10px;font-size: 20px;cursor: pointer;font-weight: 900;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form .triple-div{ldelim}width: 5%; margin-inline: 0%;{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form .triple-div{ldelim}flex-basis: calc((100% - 60px) / 4);{rdelim}
    .modal .modal-dialog .modal-content .modal-body .tecSee-form .plus-button{ldelim}flex-basis: calc((100% - 60px) / 10);height: fit-content;margin-top: 14%;{rdelim}
    .tecSee-loading-container{ldelim}position: absolute; display: flex; justify-content: center; align-items: center; width:65%;{rdelim}
    .pop-up-container {ldelim}position: fixed;top: 0;left: 0;right: 0;bottom: 0;z-index: 1500;background: rgba(0, 0, 0, 0.4);display: none;{rdelim}
    .pop-up-container.active {ldelim}display: block;{rdelim}
    .pop-up-container.remove {ldelim}animation: removeBox 0.1s linear forwards;{rdelim}
    .pop-up-container .pop-up-content-parent {ldelim}display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;height: 100%;width: 100%;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content {ldelim}width: 400px;height: 300px;max-width: 400px;padding: 25px;border-radius: 5px;background: #fff;color: #545454;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: space-evenly;-ms-flex-pack: space-evenly;justify-content: space-evenly;position: relative;transform: scale(0);{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content.active {ldelim}animation: upperBox 0.2s linear forwards;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content.remove {ldelim}animation: removeBox 0.05s linear forwards;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content #close-rental-car-popup {ldelim}position: absolute;right: 10px;top: 10px;font-size: 24px;font-weight: bolder;cursor: pointer;color: #ff5ca3;z-index: 10;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content img {ldelim}width: 95px;animation: rotateImg 0.4s 0.1s linear forwards;transform: rotate(45deg);opacity: 0;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content div.pop-up-message {ldelim}margin-top: 5px; margin-bottom:5px{rdelim}    
    .pop-up-container .pop-up-content-parent .pop-up-content p.pop-up-message {ldelim}color: #545454;font-size: 22px;{rdelim}    
    .pop-up-container .pop-up-content-parent .pop-up-content div.button-container .pop-up-button {ldelim}background-color: #ff5ca3;border-radius: 5px;font-size: 19px;font-weight: bold;padding: 10px;color: white;margin: 0 5px;display: inline-block;text-decoration: none;outline: none;border: none; min-width:100px;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content div p.proceed-message {ldelim}color: #545454;margin-bottom: 15px;font-size: 20px;text-align: center;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content div .pop-up-button#confirm-pop-up-screen {ldelim}background-color: #25c6da;{rdelim}
    .pop-up-container .pop-up-content-parent .pop-up-content div .pop-up-button#confirm-pop-up-screen.active {ldelim}display: inline-block !important;{rdelim}
    .x-icon {ldelim}align-self: start !important; cursor: pointer;{rdelim}
    .pop-up-icon {ldelim}margin-bottom: align-self: ;{rdelim}
    @keyframes upperBox {ldelim}0% {ldelim}transform: scale(0);opacity: 0;{rdelim}50% {ldelim}transform: scale(0.5);opacity: 1;{rdelim}100% {ldelim}transform: scale(1);opacity: 1;{rdelim}{rdelim}
    @keyframes removeBox {ldelim}0% {ldelim}transform: scale(1);opacity: 1;{rdelim}50% {ldelim}transform: scale(0.5);opacity: 0.5;{rdelim}100% {ldelim}transform: scale(0);opacity: 0;display: none;{rdelim}{rdelim}
    @keyframes rotateImg {ldelim}0% {ldelim}opacity: 0;{rdelim}30% {ldelim}transform: rotate(-20deg);opacity: 1;{rdelim}60% {ldelim}transform: rotate(20deg);opacity: 1;{rdelim}100% {ldelim}transform: rotate(0);opacity: 1;{rdelim}{rdelim}
    @media max-width: 1200px{ldelim}.tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table{ldelim}margin-bottom: 15px;{rdelim} {rdelim} 
    @media max-width: 1200px{ldelim}.tecSee-table-parent .tecSee-table-container{ldelim}padding: 15px;{rdelim} {rdelim} 
    @media max-width: 768px{ldelim}.tecSee-table-parent .tecSee-table-title-and-search{ldelim}gap: 20px;{rdelim}.tecSee-table-parent .tecSee-table-title-and-search h2{ldelim}text-align: center;-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}.tecSee-table-parent .tecSee-table-title-and-search input[type="search"]{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}{rdelim} 
    @import url(https://kit.fontawesome.com/23268b53f1.js);
</style>
