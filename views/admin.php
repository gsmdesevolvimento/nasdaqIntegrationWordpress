<?php

if (!defined('ABSPATH')) {
    exit('Access denied');
}

?>

<main class="nasdaq-integration wrap">

    <header class="nasdaq-integration_header">

        <h1>Integração com API Nasdaq</h1>

        <p>
            Abaixo você poderá escolher qual empresa será mostrada no site para o público os seus dados atualizados da API do Nasdaq
        </p>

    </header>

    <section class="nasdaq-integration_content">

        <table class="wp-list-table widefat fixed striped table-view-list">

            <thead>

                <tr>

                    <th scope="col" class="manage-column col-mini">
                        Símbolo
                    </th>

                    <th scope="col" class="manage-column">
                        Empresa
                    </th>

                    <th scope="col" class="manage-column">
                        Última venda
                    </th>

                    <th scope="col" class="manage-column col-small">
                        Opção
                    </th>

                </tr>

            </thead>

            <tbody id="the-list">

                <?php

                $nasdaqSymbolSelected = get_option('nasdaq_company_selected');

                $nasdaqData = Nasdaq::getDataByCurl('https://api.nasdaq.com/api/screener/stocks?tableonly=true&limit=280&exchange=NASDAQ');

                if (is_array($nasdaqData) && count($nasdaqData) > 0) {

                ?>

                    <?php foreach ($nasdaqData['data']['table']['rows'] as $data) { ?>

                        <tr>

                            <td class="col-mini"><?php echo $data['symbol']; ?></td>

                            <td><?php echo $data['name']; ?></td>

                            <td><?php echo $data['lastsale']; ?></td>

                            <td class="col-small">

                                <?php if ($data['symbol'] == $nasdaqSymbolSelected) { ?>

                                    <button class="button button-primary" disabled>
                                        Escolhido como principal
                                    </button>

                                <?php } else { ?>

                                    <a
                                        href="?page=nasdaqIntegration&nasdaq_company_selected=<?php echo $data['symbol']; ?>"
                                        class="button button-primary">
                                        Definir como principal
                                    </a>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>

                        <td cols="4">O Nasdaq não retornou dados da sua API, por favor atualize a página.</td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </section>

</main>