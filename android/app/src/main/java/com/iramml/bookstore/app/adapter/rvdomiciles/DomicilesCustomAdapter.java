package com.iramml.bookstore.app.adapter.rvdomiciles;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.iramml.bookstore.app.model.Domicile;
import com.iramml.bookstore.app.R;

import java.util.ArrayList;

public class DomicilesCustomAdapter extends RecyclerView.Adapter<DomicilesCustomAdapter.ViewHolder>{
    private Context context;
    private ArrayList<Domicile> items;
    private ClickListener listener;
    private ViewHolder viewHolder;

    public DomicilesCustomAdapter(Context context, ArrayList<Domicile> items, ClickListener listener ){
        this.context = context;
        this.items = items;
        this.listener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View view = LayoutInflater.from(context).inflate(R.layout.template_domiciles,viewGroup,false);
        viewHolder = new ViewHolder(view, listener);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder viewHolder, int i) {
        viewHolder.tvStreet.setText(String.format("%s - %s", items.get(i).getStreet(), items.get(i).getOutdoor_number()));
        viewHolder.tvAddress.setText(String.format("%s - %s - %s - %s", items.get(i).getPostal_code(), items.get(i).getCity(), items.get(i).getState(), items.get(i).getCity()));
    }

    @Override
    public int getItemCount() {
        return items.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        TextView tvStreet, tvAddress;
        ClickListener listener;

        public ViewHolder(View itemView, ClickListener listener) {
            super(itemView);
            tvStreet = itemView.findViewById(R.id.tvStreet);
            tvAddress = itemView.findViewById(R.id.tvAddress);
            this.listener = listener;
            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View view) {
            this.listener.onClick(view, getAdapterPosition());
        }
    }
}