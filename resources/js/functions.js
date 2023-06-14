const myPlugin = {
    install(app) {
        app.config.globalProperties.$print_html = (pageView = 'portrait') => {

            let htmlToPrint = '';
            let divToPrint = document.getElementsByClassName("table_content");
            const newWin = window.open("");

            htmlToPrint = `<style type="text/css" media="print">
                            @page { size: ${pageView}; }
                            table, td, th {
                                border: 1px solid;
                            }
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            .hide-btn{
                                visibility: hidden;
                            }
                        </style>`;

            newWin.document.write(htmlToPrint);
            newWin.document.write(divToPrint[0].outerHTML);
            newWin.document.close();
            newWin.print();
            newWin.close();

        },

        app.config.globalProperties.$export_excel = (table_contant, title='Management Report') => {
            axios
            .get("/api/download_xl",{
                params: {
                    table_contant: table_contant,
                    title: title
                },
                responseType: 'blob'
            })
            .then(resp => {
                if (resp.status == 200) {
                    console.log(resp);
                    const blob = new Blob([resp.data], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
                    let link = URL.createObjectURL(blob);
                    let a = document.createElement("a");
                    a.download = title +' -'+new Date().toISOString().split('T')[0];
                    a.href = link;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    toastr.success('Download Success.');
                }
            })
            .catch(error => {
                console.log(error);
                toastr.error('Something went wrong.');
            })
            .finally(() => { });
        },

        app.config.globalProperties.$export_pdf = (table_contant, orientation="P",title='Management Report') => {
            axios
            .post("/api/download_pdf",{table_contant:table_contant, title: title, orientation: orientation})
            .then(()=>{
                toastr.success('Download Success.');
            })
            .catch((error)=>{
                toastr.error('Something went wrong.');
            });
        },

        app.config.globalProperties.$getMonthName = (monthNumber) => {
            const date = new Date();
            date.setMonth(monthNumber - 1);
            return date.toLocaleString('en-US', { month: 'long' });
        },

        app.config.globalProperties.$dateConversion = (formate="Y-m-d",separator='-') => {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            let formattedDate = '';
            if(formate=="Y-m-d") formattedDate = yyyy + separator + mm + separator + dd;
            if(formate=="Y-d-m") formattedDate = yyyy + separator + dd + separator + mm;
            if(formate=="d-Y-m") formattedDate = dd + separator + yyyy + separator + mm;
            if(formate=="d-m-Y") formattedDate = dd + separator + mm + separator + yyyy;
            if(formate=="m-Y-d") formattedDate = mm + separator + yyyy + separator + dd;
            if(formate=="m-d-Y") formattedDate = mm + separator + dd + separator + yyyy;

            return formattedDate;
        }
    }
}

export default myPlugin;
