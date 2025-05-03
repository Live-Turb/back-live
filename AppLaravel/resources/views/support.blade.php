@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Suporte ao Cliente</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-headset fa-4x text-primary mb-3"></i>
                        <h5>Como podemos ajudar?</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-envelope text-primary mr-2"></i>
                                        E-mail
                                    </h5>
                                    <p class="card-text">suporte@liveturb.com</p>
                                    <small class="text-muted">Resposta em até 24 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fab fa-whatsapp text-success mr-2"></i>
                                        WhatsApp
                                    </h5>
                                    <p class="card-text">(11) 99999-9999</p>
                                    <small class="text-muted">Atendimento em horário comercial</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Envie sua mensagem</h5>
                            <form>
                                <div class="form-group">
                                    <label>Assunto</label>
                                    <select class="form-control">
                                        <option>Problemas com pagamento</option>
                                        <option>Dúvidas sobre o plano</option>
                                        <option>Problemas técnicos</option>
                                        <option>Outros assuntos</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sua mensagem</label>
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Enviar Mensagem
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Perguntas Frequentes</h5>
                        <div class="accordion" id="faqAccordion">
                            <div class="card">
                                <div class="card-header" id="faq1">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1">
                                            Como funciona a cobrança de visualizações extras?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faqCollapse1" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        O plano básico inclui 6.000 visualizações por mês. Após esse limite, cada bloco de 500 visualizações extras tem um custo de R$ 10,00.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faq2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse2">
                                            Quando minha conta é bloqueada?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faqCollapse2" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Sua conta é bloqueada quando o valor pendente de visualizações extras atinge R$ 100,00. Para evitar o bloqueio, mantenha seus pagamentos em dia.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
