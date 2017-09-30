import notify from 'common/notify';
import Api from 'common/api';

class ConfirmModal {

  $container = $('body');

  modalID = 'cashier-confirm-modal';

  tradeSn = '';

  constructor() {

    let template = `
      <div id="${this.modalID}" class="modal">
        <div class="modal-dialog cd-modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="cd-icon cd-icon-close"></i>
              </button>
              <h4 class="modal-title">${Translator.trans('cashier.confirm.title')}</h4>
            </div>
            <div class="modal-body">
              <p>
              ${Translator.trans('cashier.confirm.desc')}
              </p>
            </div>
            <div class="modal-footer">
              <a class="btn cd-btn cd-btn-flat-default" data-dismiss="modal">${Translator.trans('cashier.confirm.pick_again')}</a>
              <a class="btn cd-btn cd-btn-primary cd-btn-lg js-confirm-btn">${Translator.trans('cashier.confirm.success')}</a>
            </div>
          </div>
        <div>  
      </div>
    `;

    if (this.$container.find('#'+this.modalID).length === 0) {
      this.$container.append(template);
    }

    $('body').on('click', '.js-confirm-btn', this.checkIsPaid);
  }

  checkIsPaid() {

    Api.cashier_trade.get({
      tradeSn: this.tradeSn
    }).then(res => {
      if (res.isPaid) {
        location.href = resp.successUrl;
      } else {
        notify('danger', Translator.trans('cashier.confirm.fail_message'));
        $('#'+this.modalID).modal('hide');
      }
    });


  }

  show(tradeSn) {
    $('#'+this.modalID).modal('show');
    this.tradeSn = tradeSn;
  }
}

export default ConfirmModal;