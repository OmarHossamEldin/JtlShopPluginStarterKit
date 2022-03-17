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
    .tecSee-form{ldelim}display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin: 10px 0;{rdelim}
    .tecSee-form div,.tecSee-form .full-width{ldelim}margin: 0 10px 0 20px;-ms-flex-preferred-size: calc((100% - 60px) / 2);flex-basis: calc((100% - 60px) / 2);display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;gap: 20px;padding: 15px;{rdelim}
    .tecSee-form div.tecSee-break,.tecSee-form .full-width.tecSee-break{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;height: 0;{rdelim}
    .tecSee-form div label,.tecSee-form .full-width label{ldelim}font-size: 18px;font-weight: bolder;{rdelim}.tecSee-form div input,.tecSee-form div textarea,.tecSee-form div select,.tecSee-form .full-width input,.tecSee-form .full-width select{ldelim}padding: 15px;border-radius: 5px;border: 1px solid #b3b3b3;resize:none;{rdelim}
    .tecSee-form div select option,.tecSee-form .full-width select option{ldelim}font-size: 17px;{rdelim}
    .tecSee-form .full-width{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}
    .tecSee-form button,.tecSee-form input[type="submit"]{ldelim}-ms-flex-preferred-size: calc((100% - 60px) / 2);flex-basis: calc((100% - 60px) / 2);background-color: #5cbcf6;border-radius: 5px;padding: 15px;color: #e9ecf8;display: block;margin: 0 auto;{rdelim}
    .tecSee-form .triple-div{ldelim}flex-basis: calc((100% - 60px) / 4);{rdelim}
    .tecSee-form .plus-button{ldelim}flex-basis: calc((100% - 60px) / 10);height: fit-content;margin-top: 7%;{rdelim}
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
    @media max-width: 1200px{ldelim}.tecSee-table-parent .tecSee-table-container .tecSee-remove-padding .tecSee-table{ldelim}margin-bottom: 15px;{rdelim} {rdelim} 
    @media max-width: 1200px{ldelim}.tecSee-table-parent .tecSee-table-container{ldelim}padding: 15px;{rdelim} {rdelim} 
    @media max-width: 768px{ldelim}.tecSee-table-parent .tecSee-table-title-and-search{ldelim}gap: 20px;{rdelim}.tecSee-table-parent .tecSee-table-title-and-search h2{ldelim}text-align: center;-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}.tecSee-table-parent .tecSee-table-title-and-search input[type="search"]{ldelim}-ms-flex-preferred-size: 100%;flex-basis: 100%;{rdelim}{rdelim} 
    @import url(https://kit.fontawesome.com/23268b53f1.js)
</style>