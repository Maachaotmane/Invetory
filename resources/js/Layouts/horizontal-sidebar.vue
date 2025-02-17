<template>
  <div class="sidebar horizontal-sidebar">
    <div id="sidebar-menu-3" class="sidebar-menu">
      <ul class="nav">
        <li class="submenu">
          <a
            href="#sidebarDashboardOne"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="sidebarDashboardOne"
            :class="[
              isDashboardOneMenu ? 'active' : 'notactive',
              { subdrop: isDashboardOneMenuOpen },
            ]"
            v-on:click="isDashboardOneMenuOpen = !isDashboardOneMenuOpen"
          >
            <vue-feather type="grid"></vue-feather> <span>Main Menu</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="collapse menu-dropdown" id="sidebarDashboardOne">
            <li class="submenu">
              <a
                href="#sidebarDashboard"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarDashboard"
                :class="[
                  isDashboardMenu ? 'active' : 'notactive',
                  { subdrop: isDashboardMenuOpen },
                ]"
                v-on:click="isDashboardMenuOpen = !isDashboardMenuOpen"
              >
                <span>Dashboard</span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="collapse menu-dropdown" id="sidebarDashboard">
                <li>
                  <router-link
                    :class="
                      currentPath == '/dashboard/admin-dashboard' ? 'active' : 'notactive'
                    "
                    to="/dashboard/admin-dashboard"
                    >Admin Dashboard</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="
                      currentPath == '/dashboard/sales-dashboard' ? 'active' : 'notactive'
                    "
                    to="/dashboard/sales-dashboard"
                    >Sales Dashboard</router-link
                  >
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a
                href="#sidebarApplication"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarApplication"
                :class="[
                  isApplicationMenu ? 'active' : 'notactive',
                  { subdrop: isApplicationMenuOpen },
                ]"
                v-on:click="isApplicationMenuOpen = !isApplicationMenuOpen"
              >
                <span>Application</span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="collapse menu-dropdown" id="sidebarApplication">
                <li><router-link to="/application/chat">Chat</router-link></li>
                <li class="submenu submenu-two">
                  <a href="javascript:void(0);">
                    <span>Call</span>
                    <span class="menu-arrow inside-submenu"></span>
                  </a>
                  <ul>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/video-call' ? 'active' : 'notactive'
                        "
                        to="/call/video-call"
                        >Video Call</router-link
                      >
                    </li>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/audio-call' ? 'active' : 'notactive'
                        "
                        to="/call/audio-call"
                        >Audio Call</router-link
                      >
                    </li>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/call-history' ? 'active' : 'notactive'
                        "
                        to="/call/call-history"
                        >Call History</router-link
                      >
                    </li>
                  </ul>
                </li>
                <!-- Other menu items -->
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isApplicationMenuOpen: false,
      isInventoryMenuOpen: false,
      isSalesMenuOpen: false,
      isSalesOneMenuOpen: false,
      isSecondaryIconsMenuOpen: false,
      isTablesMenuOpen: false,
      isFormsMenuOpen: false,
      isIconsMenuOpen: false,
      isChartsMenuOpen: false,
      isSecondaryUIMenuOpen: false,
      isBaseUIMenuOpen: false,
      isRolesMenuOpen: false,
      isExpenseMenuOpen: false,
      isLayoutsMenuOpen: false,
      isUsersMenuOpen: false,
      isPurchaseMenuOpen: false,
      isAdvancedMenuOpen: false,
      isProfileMenuOpen: false,
      isAuthMenuOpen: false,
      isLoginMenuOpen: false,
      isGeneralMenuOpen: false,
      isWebsiteMenuOpen: false,
      isSystemMenuOpen: false,
      isFinancialMenuOpen: false,
      isAppMenuOpen: false,
      isSettingsMenuOpen: false,
      isPeopleMenuOpen: false,
      isAttendenceMenuOpen: false,
      isReportMenuOpen: false,
      isPagesMenuOpen: false,
      isLeavesMenuOpen: false,
      isPlacesMenuOpen: false,
      isPayrollMenuOpen: false,
      isEmployeeMenuOpen: false,
      isDashboardOneMenu: false,
      isDashboardOneMenuOpen: false,
      isDashboardMenuOpen: false,
      isOtherMenuOpen: false,
      isSalesOneMenu: false,
      isUsersMenu: false,
      isSettingsMenu: false,
      activeClass: "active",
    };
  },
  computed: {
    currentPath() {
      return this.$route.name;
    },
    isDashboardMenu() {
      return (
        this.$route.name == "/dashboard/admin-dashboard" ||
        this.$route.name == "/dashboard/sales-dashboard"
      );
    },
    isPagesMenu() {
      return (
        this.$route.name == "/error/error-404" ||
        this.$route.name == "/error/error-500" ||
        this.$route.name == "/pages/blank-page" ||
        this.$route.name == "/pages/coming-soon" ||
        this.$route.name == "/pages/under-maintenance"
      );
    },
    isLeavesMenu() {
      return (
        this.$route.name == "/leaves/leaves-admin" ||
        this.$route.name == "/leaves/leaves-employee" ||
        this.$route.name == "/leaves/leaves-admin"
      );
    },
    isPlacesMenu() {
      return (
        this.$route.name == "/places/countries" || this.$route.name == "/places/states"
      );
    },
    isEmployeeMenu() {
      return (
        this.$route.name == "/hrm/employees-grid" ||
        this.$route.name == "/hrm/department-grid" ||
        this.$route.name == "/hrm/designation" ||
        this.$route.name == "/hrm/shift"
      );
    },
    isAttendenceMenu() {
      return (
        this.$route.name == "/hrm/attendance-employee" ||
        this.$route.name == "/hrm/attendance-admin"
      );
    },
    isPayrollMenu() {
      return (
        this.$route.name == "/payroll/payroll-list" ||
        this.$route.name == "/payroll/payslip"
      );
    },
    isApplicationMenu() {
      return (
        this.$route.name == "/chat" ||
        this.$route.name == "/call/video-call" ||
        this.$route.name == "/call/audio-call" ||
        this.$route.name == "/call/call-history" ||
        this.$route.name == "/calendar" ||
        this.$route.name == "/email" ||
        this.$route.name == "/todo" ||
        this.$route.name == "/notes" ||
        this.$route.name == "/files/file-manager"
      );
    },
    isInventoryMenu() {
      return (
        this.$route.name == "/inventory/product-list" ||
        this.$route.name == "/inventory/add-product" ||
        this.$route.name == "/inventory/expired-products" ||
        this.$route.name == "/inventory/low-stocks" ||
        this.$route.name == "/inventory/category-list" ||
        this.$route.name == "/inventory/sub-categories" ||
        this.$route.name == "/inventory/brand-list" ||
        this.$route.name == "/inventory/units" ||
        this.$route.name == "/inventory/varriant-attributes" ||
        this.$route.name == "/inventory/warranty" ||
        this.$route.name == "/inventory/barcode" ||
        this.$route.name == "/inventory/qrcode"
      );
    },
    isTablesMenu() {
      return (
        this.$route.name == "/tables/tables-basic" ||
        this.$route.name == "/tables/data-tables"
      );
    },
    isLayoutsMenu() {
      return (
        this.$route.name == "/forms/form-horizontal" ||
        this.$route.name == "/forms/form-vertical" ||
        this.$route.name == "/forms/form-floating-labels" ||
        this.$route.name == "/forms/form-validation" ||
        this.$route.name == "/forms/form-select2" ||
        this.$route.name == "/forms/form-wizard"
      );
    },
    isFormsMenu() {
      return (
        this.$route.name == "/forms/form-basic-inputs" ||
        this.$route.name == "/forms/form-checkbox-radios" ||
        this.$route.name == "/forms/form-input-groups" ||
        this.$route.name == "/forms/form-grid-gutters" ||
        this.$route.name == "/forms/form-select" ||
        this.$route.name == "/forms/form-mask" ||
        this.$route.name == "/forms/form-fileupload"
      );
    },
    isSecondaryIconsMenu() {
      return (
        this.$route.name == "/forms/form-basic-inputs" ||
        this.$route.name == "/forms/form-checkbox-radios" ||
        this.$route.name == "/forms/form-input-groups" ||
        this.$route.name == "/forms/form-grid-gutters" ||
        this.$route.name == "/forms/form-select" ||
        this.$route.name == "/forms/form-mask" ||
        this.$route.name == "/forms/form-fileupload" ||
        this.$route.name == "/icons/icon-simpleline" ||
        this.$route.name == "/icons/icon-themify" ||
        this.$route.name == "/icons/icon-weather" ||
        this.$route.name == "/icons/icon-typicon" ||
        this.$route.name == "/icons/icon-flag"
      );
    },
    isIconsMenu() {
      return (
        this.$route.name == "/icons/icon-fontawesome" ||
        this.$route.name == "/icons/icon-ionic" ||
        this.$route.name == "/icons/icon-ionic" ||
        this.$route.name == "/icons/icon-material" ||
        this.$route.name == "/icons/icon-pe7"
      );
    },
    isChartsMenu() {
      return (
        this.$route.name == "/charts/chart-apex" ||
        this.$route.name == "/charts/chart-c3" ||
        this.$route.name == "/charts/chart-js" ||
        this.$route.name == "/charts/chart-morris" ||
        this.$route.name == "/charts/chart-flot"
      );
    },
    isBaseUIMenu() {
      return (
        this.$route.name == "/baseui/ui-alerts" ||
        this.$route.name == "/baseui/ui-accordion" ||
        this.$route.name == "/baseui/ui-avatar" ||
        this.$route.name == "/baseui/ui-badges" ||
        this.$route.name == "/baseui/ui-buttons" ||
        this.$route.name == "/baseui/ui-buttons-group" ||
        this.$route.name == "/baseui/ui-breadcrumb" ||
        this.$route.name == "/baseui/ui-cards" ||
        this.$route.name == "/baseui/ui-carousel" ||
        this.$route.name == "/baseui/ui-dropdowns" ||
        this.$route.name == "/baseui/ui-grid" ||
        this.$route.name == "/baseui/ui-images" ||
        this.$route.name == "/baseui/ui-lightbox" ||
        this.$route.name == "/baseui/ui-media" ||
        this.$route.name == "/baseui/ui-modals" ||
        this.$route.name == "/baseui/ui-offcanvas" ||
        this.$route.name == "/baseui/ui-pagination" ||
        this.$route.name == "/baseui/ui-popovers" ||
        this.$route.name == "/baseui/ui-progress" ||
        this.$route.name == "/baseui/ui-placeholders" ||
        this.$route.name == "/baseui/ui-rangeslider" ||
        this.$route.name == "/baseui/ui-spinner" ||
        this.$route.name == "/baseui/ui-sweetalerts" ||
        this.$route.name == "/baseui/ui-tooltips" ||
        this.$route.name == "/baseui/ui-typography" ||
        this.$route.name == "/baseui/ui-video"
      );
    },
    isSecondaryUIMenu() {
      return (
        this.$route.name == "/advancedui/ui-ribbon" ||
        this.$route.name == "/advancedui/ui-clipboard" ||
        this.$route.name == "/advancedui/ui-drag-drop" ||
        this.$route.name == "/advancedui/ui-rating" ||
        this.$route.name == "/advancedui/ui-text-editor" ||
        this.$route.name == "/advancedui/ui-counter" ||
        this.$route.name == "/advancedui/ui-scrollbar" ||
        this.$route.name == "/advancedui/ui-stickynote" ||
        this.$route.name == "/advancedui/ui-timeline"
      );
    },
    isRolesMenu() {
      return (
        this.$route.name == "/users/roles-permissions" ||
        this.$route.name == "/users/delete-account"
      );
    },
    isPeopleMenu() {
      return (
        this.$route.name == "/people/customers" ||
        this.$route.name == "/people/suppliers" ||
        this.$route.name == "/people/store-list" ||
        this.$route.name == "/people/warehouse"
      );
    },
    isExpenseMenu() {
      return (
        this.$route.name == "/finance/expenses-list" ||
        this.$route.name == "/finance/expenses-category"
      );
    },
    isPurchaseMenu() {
      return (
        this.$route.name == "/purchases/purchase-list" ||
        this.$route.name == "/purchases/purchase-order-report" ||
        this.$route.name == "/purchases/purchase-order-report" ||
        this.$route.name == "/purchases/purchase-returns" ||
        this.$route.name == "/stock/manage-stocks" ||
        this.$route.name == "/stock/stock-adjustment" ||
        this.$route.name == "/stock/stock-transfer"
      );
    },
    isSalesMenu() {
      return (
        this.$route.name == "/purchases/purchase-list" ||
        this.$route.name == "/purchases/purchase-order-report" ||
        this.$route.name == "/purchases/purchase-order-report" ||
        this.$route.name == "/purchases/purchase-returns" ||
        this.$route.name == "/stock/manage-stocks" ||
        this.$route.name == "/stock/stock-adjustment" ||
        this.$route.name == "/stock/stock-transfer" ||
        this.$route.name == "/sales/sales-list" ||
        this.$route.name == "/sales/invoice-report" ||
        this.$route.name == "/sales/sales-returns" ||
        this.$route.name == "/sales/quotation-list" ||
        this.$route.name == "/sales/pos"
      );
    },
    isProfileMenu() {
      return (
        this.$route.name == "/pages/profile" ||
        this.$route.name == "/purchases/purchase-order-report"
      );
    },
    isAuthMenu() {
      return this.$route.name == "/pages/profile" || this.$route.name == "/";
    },
    isLoginMenu() {
      return (
        this.$route.name == "/" ||
        this.$route.name == "/authentication/signin-2" ||
        this.$route.name == "/authentication/signin-3"
      );
    },
    isReportMenu() {
      return (
        this.$route.name == "/reports/sales-report" ||
        this.$route.name == "/reports/purchase-report" ||
        this.$route.name == "/reports/inventory-report" ||
        this.$route.name == "/reports/invoice-report" ||
        this.$route.name == "/reports/sales-returns" ||
        this.$route.name == "/reports/supplier-report" ||
        this.$route.name == "/reports/customer-report" ||
        this.$route.name == "/reports/expense-report" ||
        this.$route.name == "/reports/income-report" ||
        this.$route.name == "/reports/tax-report" ||
        this.$route.name == "/reports/profit-and-loss"
      );
    },
    isGeneralMenu() {
      return (
        this.$route.name == "/settings/general-settings" ||
        this.$route.name == "/settings/security-settings" ||
        this.$route.name == "/settings/notification" ||
        this.$route.name == "/settings/connected-apps"
      );
    },
    isWebsiteMenu() {
      return (
        this.$route.name == "/settings/system-settings" ||
        this.$route.name == "/settings/company-settings" ||
        this.$route.name == "/settings/localization-settings" ||
        this.$route.name == "/settings/prefixes" ||
        this.$route.name == "/settings/preference" ||
        this.$route.name == "/settings/appearance" ||
        this.$route.name == "/settings/social-authentication" ||
        this.$route.name == "/settings/language-settings"
      );
    },
    isAppMenu() {
      return (
        this.$route.name == "/settings/invoice-settings" ||
        this.$route.name == "/settings/printer-settings" ||
        this.$route.name == "/settings/pos-settings" ||
        this.$route.name == "/settings/custom-fields"
      );
    },
    isSystemMenu() {
      return (
        this.$route.name == "/settings/email-settings" ||
        this.$route.name == "/settings/sms-gateway" ||
        this.$route.name == "/settings/otp-settings" ||
        this.$route.name == "/settings/gdpr-fields"
      );
    },
    isFinancialMenu() {
      return (
        this.$route.name == "/settings/payment-gateway-settings" ||
        this.$route.name == "/settings/bank-settings-grid" ||
        this.$route.name == "/settings/tax-rates" ||
        this.$route.name == "/settings/currency-settings"
      );
    },
    isOtherMenu() {
      return (
        this.$route.name == "/settings/storage-settings" ||
        this.$route.name == "/settings/ban-ip-address"
      );
    },
  },
};
</script>
