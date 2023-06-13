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
            console.log(table_contant);
            axios
            .get("/api/download_xl",{
                params: {
                    table_contant: table_contant,
                    title: title
                },
                responseType: 'blob'
                // 'headers': {
                //     'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                //     'Content-Disposition' : 'attachment;filename="hello world.xlsx"',
                //     'Cache-Control': 'max-age=0'
                // }
            })
            // .then((response)=>{
            //     toastr.success('Successfull Download.');
            //     // window.open('/api/download_xl','_blank' );
            //     console.log(response.data);
            //     // const url = window.URL.createObjectURL(new Blob([response.data]));
            //     // const link = document.createElement('a');
            //     // link.href = url;
            //     // link.setAttribute('download', 'template.xlsx');
            //     // document.body.appendChild(link);
            //     // link.click();

            // })
            .then(resp => {
                //success callback
                console.log(resp);
                if (resp.status == 200) {
                    const blob = new Blob([resp.data], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
                    let link = URL.createObjectURL(blob);
                    let a = document.createElement("a");
                    a.download = title;
                    a.href = link;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            })
            .catch(error => {
                _.forEach(error.response.data.errors, function (
                    value,
                    el
                ) {
                    toastr.error("Error", value, {
                        onHidden: function onHidden() { }
                    });
                });
            })
            .finally(() => { });
            // .catch((error)=>{
            //     toastr.error('Something went wrong.');
            // });
        },

        app.config.globalProperties.$export_pdf = (table_contant, orientation="P",title='Management Report') => {
            axios
            .post("/api/download_pdf",{table_contant:table_contant, title: title, orientation: orientation})
            .then(()=>{
                toastr.success('Successfull Download.');
            })
            .catch((error)=>{
                toastr.error('Something went wrong.');
            });
        }

        app.config.globalProperties.$getMonthName = (monthNumber) => {
            const date = new Date();
            date.setMonth(monthNumber - 1);
            return date.toLocaleString('en-US', { month: 'long' });
        }
    }
}

export default myPlugin;
