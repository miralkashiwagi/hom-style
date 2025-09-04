export default class Drawer {
  constructor() {
    this.dialog = document.querySelector(".js-drawer-dialog");
    this.toggleButton = document.querySelector(".js-drawer-toggle");
    this.header = document.querySelector(".js-drawer-header");

    // 複製されたヘッダー要素を保持
    this.clonedHeader = null;
    // イベントリスナーの設定と初期化
    this.init();
  }

  init() {
    // 初期化時に一度だけヘッダーを複製
    this.createClonedHeader();

    // メニュー開閉
    this.toggleButton.addEventListener("click", () => this.toggleMenu());

    // Dialog外クリックで閉じる
    this.dialog.addEventListener("click", (e) => {
      if (e.target === this.dialog) {
        this.closeMenu();
      }
    });
  }

  toggleMenu() {
    if (this.dialog.open) {
      this.closeMenu();
    } else {
      this.openMenu();
    }
  }

  openMenu() {
    this.dialog.showModal();
    this.toggleButton.setAttribute("aria-expanded", "true");
  }

  closeMenu() {
    this.dialog.close();
    this.toggleButton.setAttribute("aria-expanded", "false");

    // フォーカスを元のボタンに戻す
    this.toggleButton.focus();
  }

  createClonedHeader() {
      if(!this.header) return;
    // ヘッダーを複製
    this.clonedHeader = this.header.cloneNode(true);
    this.clonedHeader.classList.add("is-cloned");

    // 複製したヘッダー内のボタンを取得して閉じるボタンに変更
    const clonedButton = this.clonedHeader.querySelector(".js-drawer-toggle");
    if (clonedButton) {
        clonedButton.setAttribute("aria-expanded", "true");
      clonedButton.classList.add("is-cloned");
      clonedButton.addEventListener("click", () => this.closeMenu());
    }

    // dialogの最初に挿入
    this.dialog.insertBefore(this.clonedHeader, this.dialog.firstChild);
  }
}
